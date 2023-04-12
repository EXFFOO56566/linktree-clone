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
use Altum\Models\User;

class AdminPlans extends Controller {

    public function index() {

        $plans = db()->orderBy('`order`', 'ASC')->get('plans');

        /* Main View */
        $data = [
            'plans' => $plans
        ];

        $view = new \Altum\View('admin/plans/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

    public function duplicate() {

        if(empty($_POST)) {
            redirect('admin/plans');
        }

        $plan_id = (int) $_POST['plan_id'];

        //ALTUMCODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

        if(!\Altum\Csrf::check()) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!$plan = db()->where('plan_id', $plan_id)->getOne('plans')) {
            redirect('admin/plans');
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            /* Insert to database */
            $plan_id = db()->insert('plans', [
                'name' => $plan->name . ' - ' . l('global.duplicated'),
                'description' => $plan->description,
                'monthly_price' => $plan->monthly_price,
                'annual_price' => $plan->annual_price,
                'lifetime_price' => $plan->lifetime_price,
                'trial_days' => $plan->trial_days,
                'settings' => $plan->settings,
                'codes_ids' => $plan->codes_ids,
                'taxes_ids' => $plan->taxes_ids,
                'color' => $plan->color,
                'status' => $plan->status,
                'order' => $plan->order + 1,
                'datetime' => \Altum\Date::$date,
            ]);

            /* Set a nice success message */
            Alerts::add_success(sprintf(l('global.success_message.create1'), '<strong>' . input_clean($plan->name) . '</strong>'));

            /* Redirect */
            redirect('admin/plan-update/' . $plan_id);

        }

        redirect('admin/plans');
    }

    public function delete() {

        $plan_id = isset($this->params[0]) ? (int) $this->params[0] : null;

        //ALTUMCODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

        if(!\Altum\Csrf::check('global_token')) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!$plan = db()->where('plan_id', $plan_id)->getOne('plans', ['plan_id', 'name'])) {
            redirect('admin/plans');
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            /* Get all the users with this plan that have subscriptions and cancel them */
            $result = database()->query("SELECT `user_id`, `payment_subscription_id` FROM `users` WHERE `plan_id` = {$plan_id} AND `payment_subscription_id` <> ''");

            while($row = $result->fetch_object()) {
                try {
                    (new User())->cancel_subscription($row->user_id);
                } catch (\Exception $exception) {
                    Alerts::add_error($exception->getCode() . ':' . $exception->getMessage());
                    redirect('admin/plans');
                }

                /* Change the user plan to custom and leave their current features they paid for on */
                db()->where('user_id', $row->user_id)->update('users', ['plan_id' => 'custom']);

                /* Clear the cache */
                \Altum\Cache::$adapter->deleteItemsByTag('user_id=' . $row->user_id);
            }

            /* Delete the plan */
            db()->where('plan_id', $plan_id)->delete('plans');

            /* Set a nice success message */
            Alerts::add_success(sprintf(l('global.success_message.delete1'), '<strong>' . $plan->name . '</strong>'));

        }

        redirect('admin/plans');
    }

}
