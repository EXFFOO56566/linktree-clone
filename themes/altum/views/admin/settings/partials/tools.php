<?php defined('ALTUMCODE') || die() ?>

<div>
    <div class="form-group custom-control custom-switch">
        <input id="is_enabled" name="is_enabled" type="checkbox" class="custom-control-input" <?= settings()->tools->is_enabled ? 'checked="checked"' : null?>>
        <label class="custom-control-label" for="is_enabled"><?= l('admin_settings.tools.is_enabled') ?></label>
    </div>

    <div class="form-group">
        <label for="access"><?= l('admin_settings.tools.access') ?></label>
        <select id="access" name="access" class="custom-select">
            <option value="everyone" <?= settings()->tools->access == 'everyone' ? 'selected="selected"' : null ?>><?= l('admin_settings.tools.access_everyone') ?></option>
            <option value="users" <?= settings()->tools->access == 'users' ? 'selected="selected"' : null ?>><?= l('admin_settings.tools.access_users') ?></option>
        </select>
    </div>

    <div class="form-group">
        <?php $tools = require APP_PATH . 'includes/tools.php'; ?>
        <label><?= l('admin_settings.tools.available_tools') . ' (' . count($tools) . ')' ?></label>
        <div class="row">
            <?php foreach($tools as $key => $value): ?>
                <div class="col-12 col-lg-6">
                    <div class="custom-control custom-checkbox my-2">
                        <input id="<?= 'tool_' . $key ?>" name="available_tools[]" value="<?= $key ?>" type="checkbox" class="custom-control-input" <?= settings()->tools->available_tools->{$key} ? 'checked="checked"' : null ?>>
                        <label class="custom-control-label d-flex align-items-center" for="<?= 'tool_' . $key ?>">
                            <?= l('tools.' . $key . '.name') ?>
                        </label>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.update') ?></button>
