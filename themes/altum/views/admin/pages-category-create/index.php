<?php defined('ALTUMCODE') || die() ?>

<nav aria-label="breadcrumb">
    <ol class="custom-breadcrumbs small">
        <li>
            <a href="<?= url('admin/pages-categories') ?>"><?= l('admin_pages_categories.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
        </li>
        <li class="active" aria-current="page"><?= l('admin_pages_category_create.breadcrumb') ?></li>
    </ol>
</nav>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 m-0"><i class="fa fa-fw fa-xs fa-book text-primary-900 mr-2"></i> <?= l('admin_pages_category_create.header') ?></h1>
</div>

<?= \Altum\Alerts::output_alerts() ?>

<div class="card <?= \Altum\Alerts::has_field_errors() ? 'border-danger' : null ?>">
    <div class="card-body">

        <form action="" method="post" role="form">
            <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />

            <div class="form-group">
                <label for="url"><i class="fa fa-fw fa-sm fa-bolt text-muted mr-1"></i> <?= l('admin_resources.main.url') ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><?= remove_url_protocol_from_url(SITE_URL) . 'pages/' ?></span>
                    </div>

                    <input id="url" type="text" name="url" class="form-control <?= \Altum\Alerts::has_field_errors('url') ? 'is-invalid' : null ?>" value="<?= $data->values['url'] ?>" placeholder="<?= l('admin_resources.main.url_placeholder') ?>" onchange="update_this_value(this, get_slug)" onkeyup="update_this_value(this, get_slug)" maxlength="256" required="required" />
                    <?= \Altum\Alerts::output_field_error('url') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="title"><i class="fa fa-fw fa-sm fa-signature text-muted mr-1"></i> <?= l('admin_resources.main.title') ?></label>
                <input id="title" type="text" name="title" class="form-control <?= \Altum\Alerts::has_field_errors('title') ? 'is-invalid' : null ?>" value="<?= $data->values['title'] ?>" maxlength="256" required="required" />
                <?= \Altum\Alerts::output_field_error('title') ?>
            </div>

            <div class="form-group" data-type="internal">
                <label for="description"><i class="fa fa-fw fa-sm fa-pen text-muted mr-1"></i> <?= l('admin_resources.main.description') ?></label>
                <input id="description" type="text" name="description" class="form-control" value="<?= $data->values['description'] ?>" maxlength="256" />
            </div>

            <div class="form-group">
                <label for="icon"><i class="fa fa-fw fa-sm fa-icons text-muted mr-1"></i> <?= l('admin_pages_categories.input.icon') ?></label>
                <input id="icon" type="text" name="icon" class="form-control" value="<?= $data->values['icon'] ?>" placeholder="<?= l('admin_pages_categories.input.icon_placeholder') ?>" maxlength="32" />
                <small class="form-text text-muted"><?= l('admin_pages_categories.input.icon_help') ?></small>
            </div>

            <div class="form-group">
                <label for="language"><i class="fa fa-fw fa-sm fa-language text-muted mr-1"></i> <?= l('admin_resources.main.language') ?></label>
                <select id="language" name="language" class="custom-select">
                    <option value="" <?= !$data->values['language'] ? 'selected="selected"' : null ?>><?= l('admin_resources.main.language_all') ?></option>
                    <?php foreach(\Altum\Language::$languages as $language): ?>
                        <option value="<?= $language['name'] ?>" <?= $data->values['language'] == $language['name'] ? 'selected="selected"' : null ?>><?= $language['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group">
                <label for="order"><i class="fa fa-fw fa-sm fa-sort text-muted mr-1"></i> <?= l('admin_resources.main.order') ?></label>
                <input id="order" type="number" name="order" class="form-control" value="<?= $data->values['order'] ?>" />
                <small class="form-text text-muted"><?= l('admin_resources.main.order_help') ?></small>
            </div>

            <button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.create') ?></button>
        </form>
    </div>
</div>
