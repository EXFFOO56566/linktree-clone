
<?php defined('ALTUMCODE') || die() ?>

<div>
    <div class="form-group">
        <label for="openai_api_key"><?= l('admin_settings.aix.openai_api_key') ?></label>
        <input id="openai_api_key" type="text" name="openai_api_key" class="form-control" value="<?= settings()->aix->openai_api_key ?>" />
    </div>

    <div class="form-group custom-control custom-switch">
        <input id="input_moderation_is_enabled" name="input_moderation_is_enabled" type="checkbox" class="custom-control-input" <?= settings()->aix->input_moderation_is_enabled ? 'checked="checked"' : null?>>
        <label class="custom-control-label" for="input_moderation_is_enabled"><?= l('admin_settings.aix.input_moderation_is_enabled') ?></label>
        <small class="form-text text-muted"><?= l('admin_settings.aix.input_moderation_is_enabled_help') ?></small>
    </div>

    <button class="btn btn-block btn-gray-200 my-4" type="button" data-toggle="collapse" data-target="#documents_container" aria-expanded="false" aria-controls="documents_container">
        <i class="fa fa-fw fa-robot fa-sm mr-1"></i> <?= l('admin_documents.menu') ?>
    </button>

    <div class="collapse" id="documents_container">
        <div class="form-group custom-control custom-switch">
            <input id="documents_is_enabled" name="documents_is_enabled" type="checkbox" class="custom-control-input" <?= settings()->aix->documents_is_enabled ? 'checked="checked"' : null?>>
            <label class="custom-control-label" for="documents_is_enabled"><?= l('admin_settings.aix.documents_is_enabled') ?></label>
        </div>

        <div class="form-group">
            <?php $ai_text_types = require \Altum\Plugin::get('aix')->path . 'includes/ai_text_types.php' ?>
            <label><?= l('admin_settings.aix.available_types') . ' (' . count($ai_text_types) . ')' ?></label>
            <div class="row">
                <?php foreach($ai_text_types as $key => $value): ?>
                    <div class="col-12 col-lg-6">
                        <div class="custom-control custom-checkbox my-2">
                            <input id="<?= 'type_' . $key ?>" name="available_types[]" value="<?= $key ?>" type="checkbox" class="custom-control-input" <?= settings()->aix->available_types->{$key} ? 'checked="checked"' : null ?>>
                            <label class="custom-control-label d-flex align-items-center" for="<?= 'type_' . $key ?>">
                                <?= l('documents.type.' . $key) ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <div class="form-group">
            <label for="documents_available_languages"><?= l('admin_settings.aix.documents_available_languages') ?></label>
            <textarea id="documents_available_languages" type="text" name="documents_available_languages" class="form-control" rows="5"><?= implode(',', settings()->aix->documents_available_languages ?? []) ?></textarea>
            <small class="form-text text-muted"><?= l('admin_settings.aix.documents_available_languages_help') ?></small>
        </div>
    </div>

    <button class="btn btn-block btn-gray-200 my-4" type="button" data-toggle="collapse" data-target="#images_container" aria-expanded="false" aria-controls="images_container">
        <i class="fa fa-fw fa-icons fa-sm mr-1"></i> <?= l('admin_images.menu') ?>
    </button>

    <div class="collapse" id="images_container">
        <div class="form-group custom-control custom-switch">
            <input id="images_is_enabled" name="images_is_enabled" type="checkbox" class="custom-control-input" <?= settings()->aix->images_is_enabled ? 'checked="checked"' : null?>>
            <label class="custom-control-label" for="images_is_enabled"><?= l('admin_settings.aix.images_is_enabled') ?></label>
        </div>

        <div class="form-group custom-control custom-switch">
            <input id="images_display_latest_on_index" name="images_display_latest_on_index" type="checkbox" class="custom-control-input" <?= settings()->aix->images_display_latest_on_index ? 'checked="checked"' : null?>>
            <label class="custom-control-label" for="images_display_latest_on_index"><?= l('admin_settings.aix.images_display_latest_on_index') ?></label>
        </div>

        <div class="form-group">
            <label for="images_available_artists"><?= l('admin_settings.aix.images_available_artists') ?></label>
            <textarea id="images_available_artists" type="text" name="images_available_artists" class="form-control" rows="5"><?= implode(',', settings()->aix->images_available_artists ?? []) ?></textarea>
            <small class="form-text text-muted"><?= l('admin_settings.aix.images_available_artists_help') ?></small>
        </div>
    </div>

    <button class="btn btn-block btn-gray-200 my-4" type="button" data-toggle="collapse" data-target="#transcriptions_container" aria-expanded="false" aria-controls="transcriptions_container">
        <i class="fa fa-fw fa-microphone-alt fa-sm mr-1"></i> <?= l('admin_transcriptions.menu') ?>
    </button>

    <div class="collapse" id="transcriptions_container">
        <div class="form-group custom-control custom-switch">
            <input id="transcriptions_is_enabled" name="transcriptions_is_enabled" type="checkbox" class="custom-control-input" <?= settings()->aix->transcriptions_is_enabled ? 'checked="checked"' : null?>>
            <label class="custom-control-label" for="transcriptions_is_enabled"><?= l('admin_settings.aix.transcriptions_is_enabled') ?></label>
        </div>
    </div>
</div>

<button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.update') ?></button>
