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
use Altum\Date;
use Altum\Title;

class DocumentUpdate extends Controller {

    public function index() {
        \Altum\Authentication::guard();

        if(!\Altum\Plugin::is_active('aix') || !settings()->aix->documents_is_enabled) {
            redirect('dashboard');
        }

        /* Team checks */
        if(\Altum\Teams::is_delegated() && !\Altum\Teams::has_access('update.documents')) {
            Alerts::add_info(l('global.info_message.team_no_access'));
            redirect('dashboard');
        }

        $document_id = isset($this->params[0]) ? (int) $this->params[0] : null;

        /* Get document details */
        if(!$document = db()->where('document_id', $document_id)->getOne('documents')) {
            redirect();
        }

        $document->settings = json_decode($document->settings ?? '');

        /* Get available projects */
        $projects = (new \Altum\Models\Projects())->get_projects_by_user_id($this->user->user_id);

        if(!empty($_POST)) {
            $_POST['name'] = input_clean($_POST['name'], 64);
            $_POST['content'] = input_clean($_POST['content']);
            $_POST['project_id'] = !empty($_POST['project_id']) && array_key_exists($_POST['project_id'], $projects) ? (int) $_POST['project_id'] : null;

            //ALTUMCODE:DEMO if(DEMO) if($this->user->user_id == 1) Alerts::add_error('Please create an account on the demo to test out this function.');

            /* Check for any errors */
            $required_fields = ['name', 'content'];
            foreach($required_fields as $field) {
                if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]) && $_POST[$field] != '0')) {
                    Alerts::add_field_error($field, l('global.error_message.empty_field'));
                }
            }

            if(!\Altum\Csrf::check()) {
                Alerts::add_error(l('global.error_message.invalid_csrf_token'));
            }

            if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

                /* Database query */
                db()->where('document_id', $document->document_id)->update('documents', [
                    'project_id' => $_POST['project_id'],
                    'name' => $_POST['name'],
                    'content' => $_POST['content'],
                    'last_datetime' => \Altum\Date::$date,
                ]);

                /* Set a nice success message */
                Alerts::add_success(sprintf(l('global.success_message.update1'), '<strong>' . $_POST['name'] . '</strong>'));

                redirect('document-update/' . $document->document_id);
            }
        }

        /* Set a custom title */
        Title::set(sprintf(l('document_update.title'), $document->name));

        /* AI Types */
        $ai_text_types = require \Altum\Plugin::get('aix')->path . 'includes/ai_text_types.php';

        /* Main View */
        $data = [
            'document' => $document,
            'projects' => $projects ?? [],
            'ai_text_types' => $ai_text_types,
        ];

        $view = new \Altum\View(\Altum\Plugin::get('aix')->path . 'views/document-update/index', (array) $this, true);

        $this->add_view_content('content', $view->run($data));
    }

}
