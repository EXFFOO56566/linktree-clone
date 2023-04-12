<?php defined('ALTUMCODE') || die() ?>

<div>
    <?php if(!in_array(settings()->license->type, ['Extended License', 'extended'])): ?>
        <div class="alert alert-primary" role="alert">
            You need to own the Extended License in order to activate the payment system.
        </div>
    <?php endif ?>

    <div class="<?= !in_array(settings()->license->type, ['Extended License', 'extended']) ? 'container-disabled' : null ?>">
        <div class="form-group custom-control custom-switch">
            <input id="is_enabled" name="is_enabled" type="checkbox" class="custom-control-input" <?= settings()->mollie->is_enabled ? 'checked="checked"' : null?>>
            <label class="custom-control-label" for="is_enabled"><?= l('admin_settings.mollie.is_enabled') ?></label>
        </div>

        <div class="form-group">
            <label for="api_key"><?= l('admin_settings.mollie.api_key') ?></label>
            <input id="api_key" type="text" name="api_key" class="form-control" value="<?= settings()->mollie->api_key ?>" />
        </div>
    </div>
</div>

<button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.update') ?></button>
