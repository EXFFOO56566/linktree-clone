<?php defined('ALTUMCODE') || die() ?>

<div class="container">
    <?= \Altum\Alerts::output_alerts() ?>

    <nav aria-label="breadcrumb">
        <ol class="custom-breadcrumbs small">
            <li>
                <a href="<?= url('projects') ?>"><?= l('projects.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
            </li>
            <li class="active" aria-current="page"><?= l('project_update.breadcrumb') ?></li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between mb-4">
        <h1 class="h4 text-truncate mb-0"><?= l('project_update.header') ?></h1>

        <?= include_view(THEME_PATH . 'views/projects/project_dropdown_button.php', ['id' => $data->project->project_id, 'resource_name' => $data->project->name]) ?>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="" method="post" role="form">
                <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />

                <div class="form-group">
                    <label for="name"><i class="fa fa-fw fa-signature fa-sm text-muted mr-1"></i> <?= l('projects.input.name') ?></label>
                    <input type="text" id="name" name="name" class="form-control" value="<?= $data->project->name ?>" required="required" />
                </div>

                <div class="form-group">
                    <label for="color"><i class="fa fa-fw fa-palette fa-sm text-muted mr-1"></i> <?= l('projects.input.color') ?></label>
                    <input type="hidden" id="color" name="color" class="form-control" value="<?= $data->project->color ?>" required="required" data-color-picker />
                    <small class="text-muted form-text"><?= l('projects.input.color_help') ?></small>
                </div>

                <button type="submit" name="submit" class="btn btn-block btn-primary"><?= l('global.update') ?></button>
            </form>

        </div>
    </div>
</div>

<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/universal_delete_modal_form.php', [
    'name' => 'project',
    'resource_id' => 'project_id',
    'has_dynamic_resource_name' => true,
    'path' => 'projects/delete'
]), 'modals'); ?>

<?php include_view(THEME_PATH . 'views/partials/color_picker_js.php') ?>
