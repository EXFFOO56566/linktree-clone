<?php defined('ALTUMCODE') || die() ?>

<div>
    <div class="form-group custom-control custom-switch">
        <input id="is_enabled" name="is_enabled" type="checkbox" class="custom-control-input" <?= settings()->twitter->is_enabled ? 'checked="checked"' : null?>>
        <label class="custom-control-label" for="is_enabled"><?= l('admin_settings.twitter.is_enabled') ?></label>
    </div>

    <div class="form-group">
        <label for="consumer_api_key"><?= l('admin_settings.twitter.consumer_api_key') ?></label>
        <input id="consumer_api_key" type="text" name="consumer_api_key" class="form-control" value="<?= settings()->twitter->consumer_api_key ?>" />
    </div>

    <div class="form-group">
        <label for="consumer_api_secret"><?= l('admin_settings.twitter.consumer_api_secret') ?></label>
        <input id="consumer_api_secret" type="text" name="consumer_api_secret" class="form-control" value="<?= settings()->twitter->consumer_api_secret ?>" />
    </div>
</div>

<button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.update') ?></button>
