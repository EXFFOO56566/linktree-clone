<?php defined('ALTUMCODE') || die() ?>

<div>
    <?php if(!in_array(settings()->license->type, ['Extended License', 'extended'])): ?>
        <div class="alert alert-primary" role="alert">
            You need to own the Extended License in order to activate the payment system.
        </div>
    <?php endif ?>

    <div class="<?= !in_array(settings()->license->type, ['Extended License', 'extended']) ? 'container-disabled' : null ?>">
        <div class="form-group custom-control custom-switch">
            <input id="is_enabled" name="is_enabled" type="checkbox" class="custom-control-input" <?= settings()->paddle->is_enabled ? 'checked="checked"' : null?>>
            <label class="custom-control-label" for="is_enabled"><?= l('admin_settings.paddle.is_enabled') ?></label>
        </div>

        <div class="form-group">
            <label for="mode"><?= l('admin_settings.paddle.mode') ?></label>
            <select id="mode" name="mode" class="custom-select">
                <option value="live" <?= settings()->paddle->mode == 'live' ? 'selected="selected"' : null ?>>live</option>
                <option value="sandbox" <?= settings()->paddle->mode == 'sandbox' ? 'selected="selected"' : null ?>>sandbox</option>
            </select>
        </div>

        <div class="form-group">
            <label for="vendor_id"><?= l('admin_settings.paddle.vendor_id') ?></label>
            <input id="vendor_id" type="text" name="vendor_id" class="form-control" value="<?= settings()->paddle->vendor_id ?>" />
        </div>

        <div class="form-group">
            <label for="api_key"><?= l('admin_settings.paddle.api_key') ?></label>
            <input id="api_key" type="text" name="api_key" class="form-control" value="<?= settings()->paddle->api_key ?>" />
        </div>

        <div class="form-group">
            <label for="public_key"><?= l('admin_settings.paddle.public_key') ?></label>
            <textarea id="public_key" name="public_key" class="form-control"><?= settings()->paddle->public_key ?></textarea>
        </div>
    </div>
</div>

<button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.update') ?></button>
