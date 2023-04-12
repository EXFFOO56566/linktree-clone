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

class Images extends Controller {

    public function index() {
        \Altum\Authentication::guard();

        if(!\Altum\Plugin::is_active('aix') || !settings()->aix->images_is_enabled) {
            redirect('dashboard');
        }

        /* Images */
        $images_current_month = db()->where('user_id', $this->user->user_id)->getValue('users', '`aix_images_current_month`');
        $available_images = $this->user->plan_settings->images_per_month_limit - $images_current_month;

        /* Prepare the filtering system */
        $filters = (new \Altum\Filters(['user_id', 'project_id', 'size', 'artist', 'lighting', 'style', 'mood'], ['name'], ['last_datetime', 'datetime', 'name']));
        $filters->set_default_order_by('image_id', settings()->main->default_order_type);
        $filters->set_default_results_per_page(settings()->main->default_results_per_page);

        /* Prepare the paginator */
        $total_rows = database()->query("SELECT COUNT(*) AS `total` FROM `images` WHERE `user_id` = {$this->user->user_id} {$filters->get_sql_where()}")->fetch_object()->total ?? 0;
        $paginator = (new \Altum\Paginator($total_rows, $filters->get_results_per_page(), $_GET['page'] ?? 1, url('images?' . $filters->get_get() . '&page=%d')));

        /* Get the images */
        $images = [];
        $images_result = database()->query("
            SELECT
                *
            FROM
                `images`
            WHERE
                `user_id` = {$this->user->user_id}
                {$filters->get_sql_where()}
            {$filters->get_sql_order_by()}
            {$paginator->get_sql_limit()}
        ");
        while($row = $images_result->fetch_object()) {
            $row->settings = json_decode($row->settings ?? '');
            $images[] = $row;
        }

        /* Export handler */
        process_export_csv($images, 'include', ['image_id', 'project_id', 'user_id', 'name', 'input', 'image', 'style', 'artist', 'lighting', 'mood', 'size', 'datetime', 'last_datetime'], sprintf(l('images.title')));
        process_export_json($images, 'include', ['image_id', 'project_id', 'user_id', 'name', 'input', 'image', 'style', 'artist', 'lighting', 'mood', 'size', 'settings', 'datetime', 'last_datetime'], sprintf(l('images.title')));

        /* Prepare the pagination view */
        $pagination = (new \Altum\View('partials/pagination', (array) $this))->run(['paginator' => $paginator]);

        /* Projects */
        $projects = (new \Altum\Models\Projects())->get_projects_by_user_id($this->user->user_id);

        /* Available */
        $images_current_month = db()->where('user_id', $this->user->user_id)->getValue('users', '`aix_images_current_month`');

        /* Prepare the View */
        $data = [
            'projects' => $projects,
            'images' => $images,
            'total_images' => $total_rows,
            'pagination' => $pagination,
            'filters' => $filters,
            'available_images' => $available_images,
            'images_current_month' => $images_current_month,
            'ai_images_lighting' => require \Altum\Plugin::get('aix')->path . 'includes/ai_images_lighting.php',
            'ai_images_styles' => require \Altum\Plugin::get('aix')->path . 'includes/ai_images_styles.php',
            'ai_images_moods' => require \Altum\Plugin::get('aix')->path . 'includes/ai_images_moods.php',
        ];

        $view = new \Altum\View(\Altum\Plugin::get('aix')->path . 'views/images/index', (array) $this, true);

        $this->add_view_content('content', $view->run($data));
    }

    public function delete() {

        \Altum\Authentication::guard();

        if(!\Altum\Plugin::is_active('aix') || !settings()->aix->images_is_enabled) {
            redirect('dashboard');
        }

        /* Team checks */
        if(\Altum\Teams::is_delegated() && !\Altum\Teams::has_access('delete.images')) {
            Alerts::add_info(l('global.info_message.team_no_access'));
            redirect('images');
        }

        if(empty($_POST)) {
            redirect('images');
        }

        $image_id = (int) query_clean($_POST['image_id']);

        //ALTUMCODE:DEMO if(DEMO) if($this->user->user_id == 1) Alerts::add_error('Please create an account on the demo to test out this function.');

        if(!\Altum\Csrf::check()) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!$image = db()->where('image_id', $image_id)->where('user_id', $this->user->user_id)->getOne('images', ['image_id', 'name', 'image'])) {
            redirect('images');
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            /* Delete file */
            \Altum\Uploads::delete_uploaded_file($image->image, 'images');

            /* Delete the resource */
            db()->where('image_id', $image_id)->delete('images');

            /* Set a nice success message */
            Alerts::add_success(sprintf(l('global.success_message.delete1'), '<strong>' . $image->name . '</strong>'));

            redirect('images');
        }

        redirect('images');
    }

}
