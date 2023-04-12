<?php defined('ALTUMCODE') || die() ?>

<nav aria-label="breadcrumb">
    <ol class="custom-breadcrumbs small">
        <li>
            <a href="<?= url('admin/languages') ?>"><?= l('admin_languages.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
        </li>
        <li class="active" aria-current="page"><?= l('admin_language_update.breadcrumb') ?></li>
    </ol>
</nav>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 mb-0 text-truncate"><i class="fa fa-fw fa-xs fa-language text-primary-900 mr-2"></i> <?= l('admin_language_update.header') ?></h1>

    <?= include_view(THEME_PATH . 'views/admin/languages/admin_language_dropdown_button.php', ['id' => $data->language['name'], 'resource_name' => $data->language['name']]) ?>
</div>

<?= \Altum\Alerts::output_alerts() ?>

<?php if($data->type): ?>
    <div class="alert alert-info" role="alert">
        <?php
        $total_translated = 0;
        $total = 0;
        foreach(\Altum\Language::$languages[\Altum\Language::$main_name]['content'] as $key => $value) {
            if(!empty(\Altum\Language::$languages[$data->language['name']]['content'][$key])) $total_translated++;
            $total++;
        }
        ?>
        <?= sprintf(l('admin_languages.info_message.total'), nr($total_translated), nr($total)) ?>
    </div>

    <?php if($data->language['name'] == \Altum\Language::$main_name): ?>
        <div class="alert alert-info" role="alert">
            <?= l('admin_languages.info_message.main') ?>
        </div>
    <?php endif ?>

    <div class="alert <?= $total > ini_get('max_input_vars') ? 'alert-danger' : 'alert-info' ?>" role="alert">
        <?= sprintf(l('admin_languages.info_message.max_input_vars'), ini_get('max_input_vars')) ?>
    </div>
<?php endif ?>

<div class="card <?= \Altum\Alerts::has_field_errors() ? 'border-danger' : null ?>">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-4">
                <a href="<?= url('admin/language-update/' . $data->language['name']) ?>" class="btn btn-block <?= !$data->type ? 'btn-primary disabled' : 'btn-outline-primary' ?>"><?= l('admin_languages.main_settings') ?></a>
            </div>

            <div class="col-4">
                <a href="<?= url('admin/language-update/' . $data->language['name'] . '/app') ?>" class="btn btn-block <?= $data->type == 'app' ? 'btn-primary disabled' : 'btn-outline-primary' ?>"><?= l('admin_languages.translate_app') ?></a>
            </div>

            <div class="col-4">
                <a href="<?= url('admin/language-update/' . $data->language['name'] . '/admin') ?>" class="btn btn-block <?= $data->type == 'admin' ? 'btn-primary disabled' : 'btn-outline-primary' ?>"><?= l('admin_languages.translate_admin') ?></a>
            </div>
        </div>

        <form action="" method="post" role="form">
            <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />

            <div class="form-group">
                <label for="language_name"><i class="fa fa-fw fa-sm fa-signature text-muted mr-1"></i> <?= l('admin_languages.main.language_name') ?></label>
                <input id="language_name" type="text" name="language_name" class="form-control <?= \Altum\Alerts::has_field_errors('language_name') ? 'is-invalid' : null ?>" value="<?= $data->language['name'] ?>" <?= ($data->language['name'] == \Altum\Language::$main_name || $data->type) ? 'readonly="readonly"' : null ?> required="required" />
                <?= \Altum\Alerts::output_field_error('language_name') ?>
                <small class="form-text text-muted"><?= l('admin_languages.main.language_name_help') ?></small>
            </div>

            <div class="form-group">
                <label for="language_code"><i class="fa fa-fw fa-sm fa-language text-muted mr-1"></i> <?= l('admin_languages.main.language_code') ?></label>
                <input id="language_code" type="text" name="language_code" class="form-control <?= \Altum\Alerts::has_field_errors('language_code') ? 'is-invalid' : null ?>" value="<?= $data->language['code'] ?>" <?= ($data->language['name'] == \Altum\Language::$main_name || $data->type) ? 'readonly="readonly"' : null ?> required="required" />
                <?= \Altum\Alerts::output_field_error('language_code') ?>
                <small class="form-text text-muted"><?= l('admin_languages.main.language_code_help') ?></small>
            </div>

            <div class="form-group">
                <label for="status"><i class="fa fa-fw fa-sm fa-dot-circle text-muted mr-1"></i> <?= l('admin_languages.main.status') ?></label>
                <select id="status" name="status" class="custom-select" <?= $data->type ? 'readonly="readonly"' : null ?>>
                    <option value="active" <?= $data->language['status'] == 'active' ? 'selected="selected"' : null ?>><?= l('global.active') ?></option>
                    <option value="disabled" <?= $data->language['status'] == 'disabled' ? 'selected="selected"' : null ?>><?= l('global.disabled') ?></option>
                </select>
            </div>

            <?php if($data->type): ?>
                <div class="d-flex align-items-center my-5">
                    <div class="flex-fill">
                        <hr class="border-gray-200">
                    </div>

                    <div class="ml-3">
                        <select id="display" name="display" class="custom-select" aria-label="<?= l('admin_languages.main.display') ?>">
                            <option value="all"><?= l('admin_languages.main.display_all') ?></option>
                            <option value="translated"><?= l('admin_languages.main.display_translated') ?></option>
                            <option value="not_translated"><?= l('admin_languages.main.display_not_translated') ?></option>
                        </select>
                    </div>
                </div>

                <div id="translations">
                    <?php $index = 1; ?>
                    <?php foreach(\Altum\Language::$languages[\Altum\Language::$main_name]['content'] as $key => $value): ?>
                        <?php if(string_starts_with('admin_', $key) && $data->type != 'admin') continue ?>
                        <?php if(!string_starts_with('admin_', $key) && $data->type != 'app') continue ?>

                        <?php $form_key = str_replace('.', '##', $key) ?>

                        <?php if($key == 'direction'): ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="<?= \Altum\Language::$main_name . '_' . $form_key ?>"><?= $key ?></label>
                                        <input id="<?= \Altum\Language::$main_name . '_' . $form_key ?>" value="<?= $value ?>" class="form-control" readonly="readonly" />
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="<?= $form_key ?>">&nbsp;</label>
                                        <select id="<?= $form_key ?>" name="<?= $form_key ?>" class="custom-select <?= \Altum\Alerts::has_field_errors($form_key) ? 'is-invalid' : null ?> <?= !isset(\Altum\Language::get($data->language['name'])[$key]) || (isset(\Altum\Language::get($data->language['name'])[$key]) && empty(\Altum\Language::get($data->language['name'])[$key])) ? 'border-danger' : null ?>" <?= $index++ >= ini_get('max_input_vars') ? 'readonly="readonly"' : null ?>>
                                            <option value="ltr" <?= (\Altum\Language::get($data->language['name'])[$key] ?? null) == 'ltr' ? 'selected="selected"' : null ?>>ltr</option>
                                            <option value="rtl" <?= (\Altum\Language::get($data->language['name'])[$key] ?? null) == 'rtl' ? 'selected="selected"' : null ?>>rtl</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="row" data-display-container>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="<?= \Altum\Language::$main_name . '_' . $form_key ?>"><?= $key ?></label>
                                        <textarea id="<?= \Altum\Language::$main_name . '_' . $form_key ?>" class="form-control" readonly="readonly"><?= $value ?></textarea>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="<?= $form_key ?>">&nbsp;</label>
                                        <textarea data-display-input id="<?= $form_key ?>" name="<?= $form_key ?>" class="form-control <?= \Altum\Alerts::has_field_errors($form_key) ? 'is-invalid' : null ?> <?= !isset(\Altum\Language::get($data->language['name'])[$key]) || (isset(\Altum\Language::get($data->language['name'])[$key]) && empty(\Altum\Language::get($data->language['name'])[$key])) ? 'border-danger' : null ?>" <?= $index++ >= ini_get('max_input_vars') ? 'readonly="readonly" data-toggle="tooltip" title="' . (sprintf(l('admin_languages.info_message.max_input_vars'), ini_get('max_input_vars'))) . '"' : null ?>><?= \Altum\Language::get($data->language['name'])[$key] ?? null ?></textarea>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.update') ?></button>
        </form>

    </div>
</div>

<?php ob_start() ?>
<script>
    let display_handler = () => {
        let display_element = document.querySelector('#display');
        let display = display_element.value;

        switch(display) {
            case 'all':

                document.querySelectorAll('#translations [data-display-container]').forEach(element => {
                    element.classList.remove('d-none');
                });

                break;

            case 'translated':

                document.querySelectorAll('#translations [data-display-input]').forEach(element => {
                    if(element.value.trim() != '') {
                        element.closest('[data-display-container]').classList.remove('d-none');
                    } else {
                        element.closest('[data-display-container]').classList.add('d-none');
                    }
                });

                break;

            case 'not_translated':

                document.querySelectorAll('#translations [data-display-input]').forEach(element => {
                    if(element.value.trim() != '') {
                        element.closest('[data-display-container]').classList.add('d-none');
                    } else {
                        element.closest('[data-display-container]').classList.remove('d-none');
                    }
                });

                break;
        }
    }

    document.querySelector('#display').addEventListener('change', display_handler);
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>

<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/universal_delete_modal_url.php', [
    'name' => 'language',
    'resource_id' => 'language_name',
    'has_dynamic_resource_name' => true,
    'path' => 'admin/languages/delete/'
]), 'modals'); ?>
