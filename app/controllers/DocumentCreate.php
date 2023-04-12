<?php
/*
 * @copyright Copyright (c) 2021 AltumCode (https://altumcode.com/)
 *
 * This software is exclusively sold through https://altumcode.com/ by the AltumCode author.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://altumcode.com/.
 */

namespace Altum\Controllers;

use Altum\Alerts;
use Altum\Response;

class DocumentCreate extends Controller {

    public function index() {
        \Altum\Authentication::guard();

        if(!\Altum\Plugin::is_active('aix') || !settings()->aix->documents_is_enabled) {
            redirect('dashboard');
        }

        /* Team checks */
        if(\Altum\Teams::is_delegated() && !\Altum\Teams::has_access('create.documents')) {
            Alerts::add_info(l('global.info_message.team_no_access'));
            redirect('documents');
        }

        /* Check for the plan limit */
        $total_rows = database()->query("SELECT COUNT(*) AS `total` FROM `documents` WHERE `user_id` = {$this->user->user_id}")->fetch_object()->total ?? 0;

        if($this->user->plan_settings->documents_limit != -1 && $total_rows >= $this->user->plan_settings->documents_limit) {
            Alerts::add_info(l('global.info_message.plan_feature_limit'));
            redirect('documents');
        }

        $available_words = $this->user->plan_settings->words_per_month_limit - db()->where('user_id', $this->user->user_id)->getValue('users', '`aix_words_current_month`');

        if($this->user->plan_settings->words_per_month_limit != -1 && $available_words <= 0) {
            Alerts::add_info(l('global.info_message.plan_feature_limit'));
            redirect('documents');
        }

        /* Get available projects */
        $projects = (new \Altum\Models\Projects())->get_projects_by_user_id($this->user->user_id);

        /* AI Types */
        $ai_text_types = require \Altum\Plugin::get('aix')->path . 'includes/ai_text_types.php';
        $ai_text_categories = require \Altum\Plugin::get('aix')->path . 'includes/ai_text_categories.php';

        /* Clear $_GET */
        foreach($_GET as $key => $value) {
            $_GET[$key] = input_clean($value);
        }

        $values = [
            'name' => $_GET['name'] ?? $_POST['name'] ?? '',
            'language' => $_GET['language'] ?? $_POST['language'] ?? reset(settings()->aix->documents_available_languages),
            'variants' => $_GET['variants'] ?? $_POST['variants'] ?? 1,
            'max_words_per_variant' => $_GET['max_words_per_variant'] ?? $_POST['max_words_per_variant'] ?? null,
            'creativity_level' => $_GET['creativity_level'] ?? $_POST['creativity_level'] ?? 'optimal',
            'type' => $_GET['type'] ?? $_POST['type'] ?? 'summarize',
            'project_id' => $_GET['project_id'] ?? $_POST['project_id'] ?? null,
        ];

        foreach($ai_text_types as $key => $value) {
            if($value['single_input']) {
                $values[$key . '_input'] = $_GET[$key . '_input'] ?? $_POST[$key . '_input'] ?? null;
            } else {
                foreach($value['inputs'] as $key => $value) {
                    $values[$key] = $_GET[$key] ?? $_POST[$key] ?? null;
                }
            }
        }

        /* Prepare the View */
        $data = [
            'values' => $values,
            'available_words' => $available_words,
            'projects' => $projects ?? [],
            'ai_text_types' => $ai_text_types,
            'ai_text_categories' => $ai_text_categories,
        ];

        $view = new \Altum\View(\Altum\Plugin::get('aix')->path . 'views/document-create/index', (array) $this, true);

        $this->add_view_content('content', $view->run($data));

    }

    public function create_ajax() {
        //ALTUMCODE:DEMO if(DEMO) if($this->user->user_id == 1) Response::json('Please create an account on the demo to test out this function.', 'error');

        if(empty($_POST)) {
            redirect();
        }

        \Altum\Authentication::guard();

        if(!\Altum\Plugin::is_active('aix') || !settings()->aix->documents_is_enabled) {
            redirect('dashboard');
        }

        /* Team checks */
        if(\Altum\Teams::is_delegated() && !\Altum\Teams::has_access('create.documents')) {
            Response::json(l('global.info_message.team_no_access'), 'error');
        }

        /* Check for the plan limit */
        $total_rows = database()->query("SELECT COUNT(*) AS `total` FROM `documents` WHERE `user_id` = {$this->user->user_id}")->fetch_object()->total ?? 0;

        if($this->user->plan_settings->documents_limit != -1 && $total_rows >= $this->user->plan_settings->documents_limit) {
            Response::json(l('global.info_message.plan_feature_limit'), 'error');
        }

        $available_words = $this->user->plan_settings->words_per_month_limit != -1 ? $this->user->plan_settings->words_per_month_limit - db()->where('user_id', $this->user->user_id)->getValue('users', '`aix_words_current_month`') : -1;

        if($this->user->plan_settings->words_per_month_limit != -1 && $available_words <= 0) {
            Response::json(l('global.info_message.plan_feature_limit'), 'error');
        }

        $this->user->plan_settings->documents_model = $this->user->plan_settings->documents_model ?? 'text-davinci-003';

        /* AI Text models */
        $ai_text_models = require \Altum\Plugin::get('aix')->path . 'includes/ai_text_models.php';
        $max_tokens_for_current_model = $ai_text_models[$this->user->plan_settings->documents_model]['max_tokens'];
        $max_words_for_current_model = floor($max_tokens_for_current_model / 1.333);

        /* Get available projects */
        $projects = (new \Altum\Models\Projects())->get_projects_by_user_id($this->user->user_id);

        /* AI Types */
        $ai_text_types = require \Altum\Plugin::get('aix')->path . 'includes/ai_text_types.php';

        $_POST['name'] = input_clean($_POST['name'], 64);
        $_POST['language'] = in_array($_POST['language'], settings()->aix->documents_available_languages) ? input_clean($_POST['language']) : reset(settings()->aix->documents_available_languages);
        $_POST['variants'] = (int) $_POST['variants'] < 0 || (int) $_POST['variants'] > 3 ? 1 : (int) $_POST['variants'];
        if(is_numeric($_POST['max_words_per_variant'])) {
            $_POST['max_words_per_variant'] = (int) $_POST['max_words_per_variant'];

            if($_POST['max_words_per_variant'] < 5) {
                $_POST['max_words_per_variant'] = 10;
            }

            if($_POST['max_words_per_variant'] > $max_words_for_current_model) {
                $_POST['max_words_per_variant'] = $max_words_for_current_model;
            }

            if($available_words != -1 && $_POST['max_words_per_variant'] > $available_words) {
                $_POST['max_words_per_variant'] = $available_words;
            }
        } else {
            $_POST['max_words_per_variant'] = $available_words != -1 ? $available_words : null;
        }
        $_POST['creativity_level'] = $_POST['creativity_level'] && in_array($_POST['creativity_level'], ['none', 'low', 'optimal', 'high', 'maximum', 'custom']) ? $_POST['creativity_level'] : 'optimal';
        $_POST['creativity_level_custom'] = isset($_POST['creativity_level_custom']) ? ((float) $_POST['creativity_level_custom'] < 0 || (float) $_POST['creativity_level_custom'] > 1 ? 0.5 : (float) $_POST['creativity_level_custom']) : null;
        $_POST['type'] = $_POST['type'] && array_key_exists($_POST['type'], $ai_text_types) ? $_POST['type'] : null;
        $_POST['project_id'] = !empty($_POST['project_id']) && array_key_exists($_POST['project_id'], $projects) ? (int) $_POST['project_id'] : null;

        /* Check for any errors */
        $required_fields = ['name', 'type'];
        foreach($required_fields as $field) {
            if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]) && $_POST[$field] != '0')) {
                Response::json(l('global.error_message.empty_fields'), 'error');
            }
        }

        if(!\Altum\Csrf::check('global_token')) {
            Response::json(l('global.error_message.invalid_csrf_token'), 'error');
        }

        /* Check for timeouts */
        if(settings()->aix->input_moderation_is_enabled) {
            $cache_instance = \Altum\Cache::$adapter->getItem('user?flagged=' . $this->user->user_id);
            if (!is_null($cache_instance->get())) {
                Response::json(l('documents.error_message.timed_out'), 'error');
            }
        }

        /* Input */
        $input = null;
        $prompt = 'Write answer in ' . $_POST['language'] . '. ';

        if($ai_text_types[$_POST['type']]['single_input']) {
            $input = input_clean($_POST[$_POST['type'] . '_input']);
            $prompt .= sprintf($ai_text_types[$_POST['type']]['prompt'], $input);
        } else {

            $inputs = [];
            foreach($ai_text_types[$_POST['type']]['inputs'] as $key => $value) {
                $inputs[$key] = input_clean($_POST[$key]);
            }

            $prompt .= vsprintf($ai_text_types[$_POST['type']]['prompt'], array_values($inputs));
            $input = json_encode($inputs);
        }

        /* Calculate tokens used by prompt */
        $tokens_used_by_prompt = floor(mb_strlen($prompt) / 3 * 1.25);

        /* Make sure the prompt tokens do not take more than 50% of the available tokens, to leave room for a proper response */
        if($tokens_used_by_prompt > floor($max_tokens_for_current_model / 2)){
            Response::json(l('documents.error_message.prompt_tokens'), 'error');
        }

        /* Decide max tokens based on input and max words per variant */
        $max_tokens = $max_tokens_for_current_model;
        if($_POST['max_words_per_variant']) {
            $max_tokens = (int) floor(($_POST['max_words_per_variant'] * 1.333));
            if($max_tokens > $max_tokens_for_current_model) {
                $max_tokens = $max_tokens_for_current_model;
            }
        }

        /* Double check to not reach the limit of tokens per request of selected model */
        if(($max_tokens + $tokens_used_by_prompt) > $max_tokens_for_current_model) {
            $max_tokens -= $tokens_used_by_prompt;
        }

        /* Temperature */
        $temperature = 0.6;
        switch($_POST['creativity_level']) {
            case 'none': $temperature = 0; break;
            case 'low': $temperature = 0.3; break;
            case 'optimal': $temperature = 0.6; break;
            case 'high': $temperature = 0.8; break;
            case 'maximum': $temperature = 1; break;
            case 'custom:': $temperature = number_format($_POST['creativity_level'], 1); break;
        }

        /* Check for moderation */
        if(settings()->aix->input_moderation_is_enabled) {
            try {
                $response = \Unirest\Request::post(
                    'https://api.openai.com/v1/moderations',
                    [
                        'Authorization' => 'Bearer ' . settings()->aix->openai_api_key,
                        'Content-Type' => 'application/json',
                    ],
                    \Unirest\Request\Body::json([
                        'input' => $prompt,
                    ])
                );

                if($response->code >= 400) {
                    Response::json($response->body->error->message, 'error');
                }

                if($response->body->results[0]->flagged ?? null) {
                    /* Time out the user for a few minutes */
                    \Altum\Cache::$adapter->save(
                        $cache_instance->set('true')->expiresAfter(3 * 60)->addTag('users')->addTag('user_id=' . $this->user->user_id)
                    );

                    /* Return the error */
                    Response::json(l('documents.error_message.flagged'), 'error');
                }

            } catch (\Exception $exception) {
                Response::json($exception->getMessage(), 'error');
            }
        }


        /* Prepare the main API request */
        switch ($ai_text_models[$this->user->plan_settings->documents_model]['type']) {
            case 'completions':
                $api_endpoint_url = 'https://api.openai.com/v1/completions';

                $body = [
                    'model' => $this->user->plan_settings->documents_model,
                    'prompt' => $prompt,
                    'max_tokens' => $max_tokens,
                    'temperature' => $temperature,
                    'n' => $_POST['variants'],
                    'user' => 'user_id:' . $this->user->user_id,
                ];
                break;

            case 'chat_completions':
                $api_endpoint_url = 'https://api.openai.com/v1/chat/completions';

                $body = [
                    'model' => $this->user->plan_settings->documents_model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'max_tokens' => $max_tokens,
                    'temperature' => $temperature,
                    'n' => $_POST['variants'],
                    'user' => 'user_id:' . $this->user->user_id,
                ];

                break;
        }

        try {
            $response = \Unirest\Request::post(
                $api_endpoint_url,
                [
                    'Authorization' => 'Bearer ' . settings()->aix->openai_api_key,
                    'Content-Type' => 'application/json',
                ],
                \Unirest\Request\Body::json($body)
            );

            if($response->code >= 400) {
                Response::json($response->body->error->message, 'error');
            }

        } catch (\Exception $exception) {
            Response::json($exception->getMessage(), 'error');
        }

        /* Words */
        $words = 0;

        /* Get the data of the response based on the API call */
        switch ($ai_text_models[$this->user->plan_settings->documents_model]['type']) {
            case 'completions':
                /* AI Content */
                if(count($response->body->choices) > 1) {
                    $content = '';

                    foreach($response->body->choices as $key => $choice) {
                        $content .= sprintf(l('documents.variant_x'), ($key+1)) . "\r\n";
                        $content .= "--------------------\r\n";
                        $content .= trim($choice->text) . "\r\n\r\n\r\n";
                        $words += count(explode(' ', (trim($choice->text))));
                    }
                } else {
                    $content = trim($response->body->choices[0]->text);
                    $words += count(explode(' ', ($content)));
                }
                break;

            case 'chat_completions':
                /* AI Content */
                if(count($response->body->choices) > 1) {
                    $content = '';

                    foreach($response->body->choices as $key => $choice) {
                        $content .= sprintf(l('documents.variant_x'), ($key+1)) . "\r\n";
                        $content .= "--------------------\r\n";
                        $content .= trim($choice->message->content) . "\r\n\r\n\r\n";
                        $words += count(explode(' ', (trim($choice->message->content))));
                    }
                } else {
                    $content = trim($response->body->choices[0]->message->content);
                    $words += count(explode(' ', ($content)));
                }
                break;
        }

        $content = trim($content);

        /* Settings of request */
        $settings = json_encode([
            'language' => $_POST['language'],
            'variants' => $_POST['variants'],
            'max_words_per_variant' => $_POST['max_words_per_variant'],
            'creativity_level' => $_POST['creativity_level'],
            'creativity_level_custom' => $_POST['creativity_level_custom'],
        ]);

        /* Prepare the statement and execute query */
        $document_id = db()->insert('documents', [
            'user_id' => $this->user->user_id,
            'project_id' => $_POST['project_id'],
            'name' => $_POST['name'],
            'type' => $_POST['type'],
            'input' => $input,
            'content' => $content,
            'words' => $words,
            'settings' => $settings,
            'datetime' => \Altum\Date::$date,
        ]);

        /* Prepare the statement and execute query */
        db()->where('user_id', $this->user->user_id)->update('users', [
            'aix_words_current_month' => db()->inc($words)
        ]);

        /* Set a nice success message */
        Response::json(sprintf(l('global.success_message.create1'), '<strong>' . $_POST['name'] . '</strong>'), 'success', ['url' => url('document-update/' . $document_id)]);

    }

}
