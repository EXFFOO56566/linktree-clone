<?php defined('ALTUMCODE') || die() ?>

<div>
    <div class="form-group custom-control custom-switch">
        <input id="is_enabled" name="is_enabled" type="checkbox" class="custom-control-input" <?= settings()->facebook->is_enabled ? 'checked="checked"' : null?>>
        <label class="custom-control-label" for="is_enabled"><?= l('admin_settings.facebook.is_enabled') ?></label>
    </div>

    <div class="form-group">
        <label for="app_id"><?= l('admin_settings.facebook.app_id') ?></label>
        <input id="app_id" type="text" name="app_id" class="form-control" value="<?= settings()->facebook->app_id ?>" />
    </div>

    <div class="form-group">
        <label for="app_secret"><?= l('admin_settings.facebook.app_secret') ?></label>
        <input id="app_secret" type="text" name="app_secret" class="form-control" value="<?= settings()->facebook->app_secret ?>" />
    </div>
</div>

<button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.update') ?></button>
