<?php defined('ALTUMCODE') || die() ?>

<nav aria-label="breadcrumb">
    <ol class="custom-breadcrumbs small">
        <li>
            <a href="<?= url('admin/blog-posts') ?>"><?= l('admin_pages.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
        </li>
        <li class="active" aria-current="page"><?= l('admin_blog_post_create.breadcrumb') ?></li>
    </ol>
</nav>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 m-0"><i class="fa fa-fw fa-xs fa-paste text-primary-900 mr-2"></i> <?= l('admin_blog_post_create.header') ?></h1>
</div>

<?= \Altum\Alerts::output_alerts() ?>

<div class="card <?= \Altum\Alerts::has_field_errors() ? 'border-danger' : null ?>">
    <div class="card-body">
        <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />

            <div class="form-group">
                <label for="url"><i class="fa fa-fw fa-sm fa-bolt text-muted mr-1"></i> <?= l('admin_blog.main.url') ?></label>
                <div class="input-group">
                    <div id="url_prepend" class="input-group-prepend">
                        <span class="input-group-text"><?= remove_url_protocol_from_url(SITE_URL) . 'blog/' ?></span>
                    </div>

                    <input id="url" type="text" name="url" class="form-control <?= \Altum\Alerts::has_field_errors('url') ? 'is-invalid' : null ?>" value="<?= $data->values['url'] ?>" placeholder="<?= l('admin_blog.main.url_placeholder') ?>" onchange="update_this_value(this, get_slug)" onkeyup="update_this_value(this, get_slug)" maxlength="256" required="required" />
                    <?= \Altum\Alerts::output_field_error('url') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="title"><i class="fa fa-fw fa-sm fa-signature text-muted mr-1"></i> <?= l('admin_blog.main.title') ?></label>
                <input id="title" type="text" name="title" class="form-control <?= \Altum\Alerts::has_field_errors('title') ? 'is-invalid' : null ?>" value="<?= $data->values['title'] ?>" maxlength="256" required="required" />
                <?= \Altum\Alerts::output_field_error('title') ?>
            </div>

            <div class="form-group">
                <label for="description"><i class="fa fa-fw fa-sm fa-pen text-muted mr-1"></i> <?= l('admin_blog.main.description') ?></label>
                <input id="description" type="text" name="description" class="form-control" value="<?= $data->values['description'] ?>" maxlength="256" />
            </div>

            <div class="form-group">
                <label for="keywords"><i class="fa fa-fw fa-sm fa-file-word text-muted mr-1"></i> <?= l('admin_blog.main.keywords') ?></label>
                <input id="keywords" type="text" name="keywords" class="form-control" value="<?= $data->values['keywords'] ?>" maxlength="256" />
            </div>

            <div class="form-group">
                <label for="image"><i class="fa fa-fw fa-sm fa-image text-muted mr-1"></i> <?= l('admin_blog.main.image') ?></label>
                <input id="image" type="file" name="image" accept="<?= \Altum\Uploads::get_whitelisted_file_extensions_accept('blog') ?>" class="form-control-file altum-file-input" />
                <small class="form-text text-muted"><?= sprintf(l('global.accessibility.whitelisted_file_extensions'), \Altum\Uploads::get_whitelisted_file_extensions_accept('blog')) . ' ' . sprintf(l('global.accessibility.file_size_limit'), get_max_upload()) ?></small>
            </div>

            <div class="form-group">
                <label for="editor"><i class="fa fa-fw fa-sm fa-newspaper text-muted mr-1"></i> <?= l('admin_blog.main.editor') ?></label>
                <select id="editor" name="editor" class="custom-select">
                    <option value="wysiwyg" <?= $data->values['editor'] == 'wysiwyg' ? 'selected="selected"' : null ?>><?= l('admin_blog.main.editor_wysiwyg') ?></option>
                    <option value="raw" <?= $data->values['editor'] == 'raw' ? 'selected="selected"' : null ?>><?= l('admin_blog.main.editor_raw') ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="content"><i class="fa fa-fw fa-sm fa-paragraph text-muted mr-1"></i> <?= l('admin_blog.main.content') ?></label>
                <div id="quill_container">
                    <div id="quill" style="height: 15rem;"></div>
                </div>
                <textarea name="content" id="content" class="form-control d-none" style="height: 15rem;"><?= $data->values['content'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="blog_posts_category_id"><i class="fa fa-fw fa-sm fa-map text-muted mr-1"></i> <?= l('admin_blog.main.blog_posts_category_id') ?></label>
                <select id="blog_posts_category_id" name="blog_posts_category_id" class="custom-select">
                    <?php foreach($data->blog_posts_categories as $row): ?>
                        <option value="<?= $row->blog_posts_category_id ?>" <?= $data->values['blog_posts_category_id'] == $row->blog_posts_category_id ? 'selected="selected"' : null ?>><?= $row->title ?></option>
                    <?php endforeach ?>

                    <option value="" <?= $data->values['blog_posts_category_id'] == '' ? 'selected="selected"' : null ?>><?= l('admin_blog.main.blog_posts_category_id_null') ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="language"><i class="fa fa-fw fa-sm fa-language text-muted mr-1"></i> <?= l('admin_blog.main.language') ?></label>
                <select id="language" name="language" class="custom-select">
                    <option value="" <?= !$data->values['language'] ? 'selected="selected"' : null ?>><?= l('admin_blog.main.language_all') ?></option>
                    <?php foreach(\Altum\Language::$languages as $language): ?>
                        <option value="<?= $language['name'] ?>" <?= $data->values['language'] == $language['name'] ? 'selected="selected"' : null ?>><?= $language['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="form-group custom-control custom-switch">
                <input id="is_published" name="is_published" type="checkbox" class="custom-control-input" <?=  $data->values['is_published'] ? 'checked="checked"' : null ?>>
                <label class="custom-control-label" for="is_published"><i class="fa fa-fw fa-sm fa-dot-circle text-muted mr-1"></i> <?= l('admin_blog.main.is_published') ?></label>
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
        if(event && !confirm(<?= json_encode(l('admin_blog.main.editor_confirm')) ?>)) {
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
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
