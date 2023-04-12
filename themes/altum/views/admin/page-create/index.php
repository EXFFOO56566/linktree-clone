<?php defined('ALTUMCODE') || die() ?>

<nav aria-label="breadcrumb">
    <ol class="custom-breadcrumbs small">
        <li>
            <a href="<?= url('admin/pages') ?>"><?= l('admin_pages.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
        </li>
        <li class="active" aria-current="page"><?= l('admin_page_create.breadcrumb') ?></li>
    </ol>
</nav>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 m-0"><i class="fa fa-fw fa-xs fa-copy text-primary-900 mr-2"></i> <?= l('admin_page_create.header') ?></h1>
</div>

<?= \Altum\Alerts::output_alerts() ?>

<div class="card <?= \Altum\Alerts::has_field_errors() ? 'border-danger' : null ?>">
    <div class="card-body">
        <form action="" method="post" role="form">
            <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />

            <div class="form-group">
                <label for="type"><i class="fa fa-fw fa-sm fa-fingerprint text-muted mr-1"></i> <?= l('admin_resources.main.type') ?></label>
                <select id="type" name="type" class="custom-select">
                    <option value="internal" <?= $data->values['type'] == 'internal' ? 'selected="selected"' : null ?>><?= l('admin_resources.main.type_internal') ?></option>
                    <option value="external" <?= $data->values['type'] == 'external' ? 'selected="selected"' : null ?>><?= l('admin_resources.main.type_external') ?></option>
                </select>
            </div>

            <div class="form-group" data-type="internal">
                <label for="url"><i class="fa fa-fw fa-sm fa-bolt text-muted mr-1"></i> <?= l('admin_resources.main.url') ?></label>
                <div class="input-group">
                    <div id="url_prepend" class="input-group-prepend">
                        <span class="input-group-text"><?= remove_url_protocol_from_url(SITE_URL) . 'page/' ?></span>
                    </div>

                    <input id="url" type="text" name="url" class="form-control <?= \Altum\Alerts::has_field_errors('url') ? 'is-invalid' : null ?>" value="<?= $data->values['url'] ?>" placeholder="<?= l('admin_resources.main.url_internal_placeholder') ?>" onchange="update_this_value(this, get_slug)" onkeyup="update_this_value(this, get_slug)" maxlength="256" required="required" />
                    <?= \Altum\Alerts::output_field_error('url') ?>
                </div>
            </div>

            <div class="form-group" data-type="external">
                <label for="url"><i class="fa fa-fw fa-sm fa-bolt text-muted mr-1"></i> <?= l('admin_resources.main.url') ?></label>
                <input id="url" type="url" name="url" class="form-control <?= \Altum\Alerts::has_field_errors('url') ? 'is-invalid' : null ?>" value="<?= $data->values['url'] ?>" placeholder="<?= l('admin_resources.main.url_external_placeholder') ?>" maxlength="256" required="required" />
                <?= \Altum\Alerts::output_field_error('url') ?>
            </div>

            <div class="form-group custom-control custom-switch" data-type="external">
                <input id="open_in_new_tab" name="open_in_new_tab" type="checkbox" class="custom-control-input" <?= $data->values['open_in_new_tab'] ? 'checked="checked"' : null ?>>
                <label class="custom-control-label" for="open_in_new_tab"><i class="fa fa-fw fa-sm fa-external-link-alt text-muted mr-1"></i> <?= l('admin_resources.main.open_in_new_tab') ?></label>
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

            <div class="form-group" data-type="internal">
                <label for="keywords"><i class="fa fa-fw fa-sm fa-file-word text-muted mr-1"></i> <?= l('admin_resources.main.keywords') ?></label>
                <input id="keywords" type="text" name="keywords" class="form-control" value="<?= $data->values['keywords'] ?>" maxlength="256" />
                <small class="form-text text-muted"><?= l('admin_resources.main.keywords_help') ?></small>
            </div>

            <div class="form-group" data-type="internal">
                <label for="editor"><i class="fa fa-fw fa-sm fa-newspaper text-muted mr-1"></i> <?= l('admin_resources.main.editor') ?></label>
                <select id="editor" name="editor" class="custom-select">
                    <option value="wysiwyg" <?= $data->values['editor'] == 'wysiwyg' ? 'selected="selected"' : null ?>><?= l('admin_resources.main.editor_wysiwyg') ?></option>
                    <option value="raw" <?= $data->values['editor'] == 'raw' ? 'selected="selected"' : null ?>><?= l('admin_resources.main.editor_raw') ?></option>
                </select>
            </div>

            <div class="form-group" data-type="internal">
                <label for="content"><i class="fa fa-fw fa-sm fa-paragraph text-muted mr-1"></i> <?= l('admin_resources.main.content') ?></label>
                <div id="quill_container">
                    <div id="quill" style="height: 15rem;"></div>
                </div>
                <textarea name="content" id="content" class="form-control d-none" style="height: 15rem;"><?= $data->values['content'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="pages_category_id"><i class="fa fa-fw fa-sm fa-book text-muted mr-1"></i> <?= l('admin_resources.main.pages_category_id') ?></label>
                <select id="pages_category_id" name="pages_category_id" class="custom-select">
                    <?php foreach($data->pages_categories as $row): ?>
                        <option value="<?= $row->pages_category_id ?>" <?= $data->values['pages_category_id'] == $row->pages_category_id ? 'selected="selected"' : null ?>><?= $row->title ?></option>
                    <?php endforeach ?>

                    <option value="" <?= $data->values['pages_category_id'] == '' ? 'selected="selected"' : null ?>><?= l('admin_resources.main.pages_category_id_null') ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="position"><i class="fa fa-fw fa-sm fa-thumbtack text-muted mr-1"></i> <?= l('admin_resources.main.position') ?></label>
                <select id="position" name="position" class="custom-select">
                    <option value="bottom" <?= $data->values['position'] == 'bottom' ? 'selected="selected"' : null ?>><?= l('admin_resources.main.position_bottom') ?></option>
                    <option value="top" <?= $data->values['position'] == 'top' ? 'selected="selected"' : null ?>><?= l('admin_resources.main.position_top') ?></option>
                    <option value="hidden" <?= $data->values['position'] == 'hidden' ? 'selected="selected"' : null ?>><?= l('admin_resources.main.position_hidden') ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="language"><i class="fa fa-fw fa-sm fa-language text-muted mr-1"></i> <?= l('admin_resources.main.language') ?></label>
                <select id="language" name="language" class="custom-select">
                    <option value="" <?= !$data->values['language'] ? 'selected="selected"' : null ?>><?= l('admin_blog.main.language_all') ?></option>
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

            <div class="form-group custom-control custom-switch">
                <input id="is_published" name="is_published" type="checkbox" class="custom-control-input" <?= $data->values['is_published'] ? 'checked="checked"' : null ?>>
                <label class="custom-control-label" for="is_published"><i class="fa fa-fw fa-sm fa-dot-circle text-muted mr-1"></i> <?= l('admin_resources.main.is_published') ?></label>
            </div>

            <button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.create') ?></button>
        </form>
    </div>
</div>

<?php ob_start() ?>
<link href="<?= ASSETS_FULL_URL . 'css/libraries/quill.snow.css?v=' . PRODUCT_CODE ?>" rel="stylesheet" media="screen,print">
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<?php ob_start() ?>
<script src="<?= ASSETS_FULL_URL . 'js/libraries/quill.min.js' ?>"></script>

<script>
    'use strict';

    let quill = new Quill('#quill', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ "font": [] }, { "size": ["small", false, "large", "huge"] }],
                ["bold", "italic", "underline", "strike"],
                [{ "color": [] }, { "background": [] }],
                [{ "script": "sub" }, { "script": "super" }],
                [{ "header": 1 }, { "header": 2 }, "blockquote", "code-block"],
                [{ "list": "ordered" }, { "list": "bullet" }, { "indent": "-1" }, { "indent": "+1" }],
                [{ "direction": "rtl" }, { "align": [] }],
                ["link", "image", "video", "formula"],
                ["clean"]
            ]
        },
    });

    quill.root.innerHTML = document.querySelector('#content').value;

    document.querySelector('form').addEventListener('submit', event => {
        let editor = document.querySelector('#editor').value;

        if(editor == 'wysiwyg') {
            document.querySelector('#content').value = quill.root.innerHTML;
        }
    });

    /* Editor change handlers */
    let current_editor = document.querySelector('#editor').value;

    let editor_handler = (event = null) => {
        if(event && !confirm(<?= json_encode(l('admin_resources.main.editor_confirm')) ?>)) {
            document.querySelector('#editor').value = current_editor;
            return;
        }

        let editor = document.querySelector('#editor').value;

        switch(editor) {
            case 'wysiwyg':
                document.querySelector('#quill_container').classList.remove('d-none');
                quill.enable(true);
                // quill.root.innerHTML = document.querySelector('#content').value;
                document.querySelector('#content').classList.add('d-none');
                break;

            case 'raw':
                // document.querySelector('#content').value = quill.root.innerHTML;
                document.querySelector('#quill_container').classList.add('d-none');
                quill.enable(false);
                document.querySelector('#content').classList.remove('d-none');
                break;
        }

        current_editor = document.querySelector('#editor').value;
    };

    document.querySelector('#editor').addEventListener('change', editor_handler);
    editor_handler();

    /* Type handler */
    let type_handler = () => {
        let type = document.querySelector('select[name="type"]').value;

        document.querySelectorAll(`[data-type]:not([data-type="${type}"])`).forEach(element => {
            element.classList.add('d-none');
            let input = element.querySelector('input');

            if(input) {
                input.setAttribute('disabled', 'disabled');
                if(input.getAttribute('required')) {
                    input.setAttribute('data-is-required', 'true');
                }
                input.removeAttribute('required');
            }
        });

        document.querySelectorAll(`[data-type="${type}"]`).forEach(element => {
            element.classList.remove('d-none');
            let input = element.querySelector('input');

            if(input) {
                input.removeAttribute('disabled');
                if(input.getAttribute('data-is-required')) {
                    input.setAttribute('required', 'required')
                }
            }
        });
    }

    type_handler();

    document.querySelector('select[name="type"]') && document.querySelector('select[name="type"]').addEventListener('change', type_handler);
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
