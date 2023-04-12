<?php defined('ALTUMCODE') || die() ?>

<div class="container">
    <?= \Altum\Alerts::output_alerts() ?>

    <nav aria-label="breadcrumb">
        <ol class="custom-breadcrumbs small">
            <li>
                <a href="<?= url('teams-system') ?>"><?= l('teams_system.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
            </li>
            <li>
                <a href="<?= url('teams') ?>"><?= l('teams.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
            </li>
            <li>
                <a href="<?= url('team/' . $data->team->team_id) ?>"><?= l('team.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
            </li>
            <li class="active" aria-current="page"><?= l('team_member_update.breadcrumb') ?></li>
        </ol>
    </nav>

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-truncate"><?= l('team_member_update.header') ?></h1>

        <?= include_view(THEME_PATH . 'views/team/team_member_dropdown_button.php', ['id' => $data->team_member->team_member_id, 'resource_name' => $data->team_member->user_email]) ?>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="" method="post" role="form">
                <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />

                <div class="form-group">
                    <label for="user_email"><i class="fa fa-fw fa-envelope fa-sm text-muted mr-1"></i> <?= l('global.email') ?></label>
                    <input type="email" id="user_email" name="user_email" class="form-control <?= \Altum\Alerts::has_field_errors('user_email') ? 'is-invalid' : null ?>" value="<?= $data->team_member->user_email ?>" disabled="disabled" />
                    <?= \Altum\Alerts::output_field_error('user_email') ?>
                </div>

                <div class="form-group">
                    <label for="access"><i class="fa fa-fw fa-sm fa-check-double text-muted mr-1"></i> <?= l('team_members.input.access') ?></label>
                    <select id="access" name="access[]" class="custom-select" multiple="multiple">
                        <?php foreach($data->teams_access as $key => $value): ?>
                        <optgroup label="<?=  l('team_members.input.access.' . $key) ?>">
                            <?php foreach($data->teams_access[$key] as $access_key => $access_translation): ?>
                                <option value="<?= $access_key ?>" <?= $data->team_member->access->{$access_key} ? 'selected="selected"' : null ?>>
                                    <?= $access_translation ?>
                                </option>
                            <?php endforeach ?>
                        </optgroup>
                        <?php endforeach ?>
                    </select>
                    <small class="form-text text-muted"><?= l('team_members.input.access_help') ?></small>
                </div>

                <div class="alert alert-info"><?= l('team_members.info_message.access') ?></div>

                <button type="submit" name="submit" class="btn btn-block btn-primary mt-3"><?= l('global.update') ?></button>
            </form>

        </div>
    </div>
</div>

<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/universal_delete_modal_form.php', [
    'name' => 'team_member',
    'resource_id' => 'team_member_id',
    'has_dynamic_resource_name' => true,
    'path' => 'teams-members/delete'
]), 'modals'); ?>
