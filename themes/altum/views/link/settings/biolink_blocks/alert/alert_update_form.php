<?php defined('ALTUMCODE') || die() ?>

<form name="update_biolink_" method="post" role="form">
    <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" required="required" />
    <input type="hidden" name="request_type" value="update" />
    <input type="hidden" name="block_type" value="alert" />
    <input type="hidden" name="biolink_block_id" value="<?= $row->biolink_block_id ?>" />

    <div class="notification-container"></div>

    <div class="form-group">
        <label for="<?= 'alert_text_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-paragraph fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.text') ?></label>
        <textarea id="<?= 'alert_text_' . $row->biolink_block_id ?>" class="form-control" name="text" maxlength="2048"><?= $row->settings->text ?></textarea>
    </div>

    <div class="form-group">
        <label for="<?= 'alert_icon_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-globe fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.icon') ?></label>
        <input id="<?= 'alert_icon_' . $row->biolink_block_id ?>" type="text" name="icon" class="form-control" value="<?= $row->settings->icon ?>" placeholder="<?= l('create_biolink_link_modal.input.icon_placeholder') ?>" />
        <small class="form-text text-muted"><?= l('create_biolink_link_modal.input.icon_help') ?></small>
    </div>

    <div class="form-group">
        <label for="<?= 'alert_location_url_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-link fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.location_url') ?></label>
        <input id="<?= 'alert_location_url_' . $row->biolink_block_id ?>" type="text" class="form-control" name="location_url" value="<?= $row->location_url ?>" maxlength="2048" placeholder="<?= l('create_biolink_link_modal.input.location_url_placeholder') ?>" />
    </div>

    <div class="form-group custom-control custom-switch">
        <input
                id="<?= 'alert_open_in_new_tab_' . $row->biolink_block_id ?>"
                name="open_in_new_tab" type="checkbox"
                class="custom-control-input"
            <?= $row->settings->open_in_new_tab ? 'checked="checked"' : null ?>
        >
        <label class="custom-control-label" for="<?= 'alert_open_in_new_tab_' . $row->biolink_block_id ?>"><?= l('create_biolink_link_modal.input.open_in_new_tab') ?></label>
    </div>

    <div class="form-group custom-control custom-switch">
        <input
                id="<?= 'alert_display_close_button_' . $row->biolink_block_id ?>"
                name="display_close_button" type="checkbox"
                class="custom-control-input"
            <?= $row->settings->display_close_button ? 'checked="checked"' : null ?>
        >
        <label class="custom-control-label" for="<?= 'alert_display_close_button_' . $row->biolink_block_id ?>"><?= l('create_biolink_alert_modal.display_close_button') ?></label>
    </div>

    <div class="form-group">
        <label for="<?= 'alert_alert_pause_after_closed_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-sort-numeric-up fa-sm text-muted mr-1"></i> <?= l('create_biolink_alert_modal.alert_pause_after_closed') ?></label>
        <input id="<?= 'alert_alert_pause_after_closed_' . $row->biolink_block_id ?>" type="number" min="0" class="form-control" name="alert_pause_after_closed" value="<?= $row->settings->alert_pause_after_closed ?>" />
    </div>

    <button class="btn btn-block btn-gray-300 my-4" type="button" data-toggle="collapse" data-target="#<?= 'button_settings_container_' . $row->biolink_block_id ?>" aria-expanded="false" aria-controls="<?= 'button_settings_container_' . $row->biolink_block_id ?>">
        <?= l('create_biolink_link_modal.button_header') ?>
    </button>

    <div class="collapse" id="<?= 'button_settings_container_' . $row->biolink_block_id ?>">
        <div <?= $this->user->plan_settings->custom_colored_links ? null : 'data-toggle="tooltip" title="' . l('global.info_message.plan_feature_no_access') . '"' ?>>
            <div class="<?= $this->user->plan_settings->custom_colored_links ? null : 'container-disabled' ?>">
                <div class="form-group">
                    <label for="<?= 'alert_text_color_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-paint-brush fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.text_color') ?></label>
                    <input id="<?= 'alert_text_color_' . $row->biolink_block_id ?>" type="hidden" name="text_color" class="form-control" value="<?= $row->settings->text_color ?>" required="required" />
                    <div class="text_color_pickr"></div>
                </div>

                <div class="form-group">
                    <label for="<?= 'block_text_alignment_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-align-center fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.text_alignment') ?></label>
                    <div class="row btn-group-toggle" data-toggle="buttons">
                        <?php foreach(['center', 'left', 'right', 'justify'] as $text_alignment): ?>
                            <div class="col-4">
                                <label class="btn btn-light btn-block <?= ($row->settings->text_alignment  ?? null) == $text_alignment ? 'active"' : null?>">
                                    <input type="radio" name="text_alignment" value="<?= $text_alignment ?>" class="custom-control-input" <?= ($row->settings->text_alignment  ?? null) == $text_alignment ? 'checked="checked"' : null ?> />
                                    <i class="fa fa-fw fa-align-<?= $text_alignment ?> fa-sm mr-1"></i> <?= l('create_biolink_link_modal.input.text_alignment.' . $text_alignment) ?>
                                </label>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="<?= 'alert_background_color_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-fill fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.background_color') ?></label>
                    <input id="<?= 'alert_background_color_' . $row->biolink_block_id ?>" type="hidden" name="background_color" class="form-control" value="<?= $row->settings->background_color ?>" required="required" />
                    <div class="background_color_pickr"></div>
                </div>

                <div class="form-group">
                    <label for="<?= 'alert_border_width_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-border-style fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.border_width') ?></label>
                    <input id="<?= 'alert_border_width_' . $row->biolink_block_id ?>" type="range" min="0" max="5" class="form-control" name="border_width" value="<?= $row->settings->border_width ?>" required="required" />
                </div>

                <div class="form-group">
                    <label for="<?= 'alert_border_color_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-fill fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.border_color') ?></label>
                    <input id="<?= 'alert_border_color_' . $row->biolink_block_id ?>" type="hidden" name="border_color" class="form-control" value="<?= $row->settings->border_color ?>" required="required" />
                    <div class="border_color_pickr"></div>
                </div>

                <div class="form-group">
                    <label for="<?= 'block_border_radius_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-border-all fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.border_radius') ?></label>
                    <div class="row btn-group-toggle" data-toggle="buttons">
                        <div class="col-4">
                            <label class="btn btn-light btn-block <?= ($row->settings->border_radius  ?? null) == 'straight' ? 'active"' : null?>">
                                <input type="radio" name="border_radius" value="straight" class="custom-control-input" <?= ($row->settings->border_radius  ?? null) == 'straight' ? 'checked="checked"' : null?> />
                                <i class="fa fa-fw fa-square-full fa-sm mr-1"></i> <?= l('create_biolink_link_modal.input.border_radius_straight') ?>
                            </label>
                        </div>
                        <div class="col-4">
                            <label class="btn btn-light btn-block <?= ($row->settings->border_radius  ?? null) == 'round' ? 'active' : null?>">
                                <input type="radio" name="border_radius" value="round" class="custom-control-input" <?= ($row->settings->border_radius  ?? null) == 'round' ? 'checked="checked"' : null?> />
                                <i class="fa fa-fw fa-circle fa-sm mr-1"></i> <?= l('create_biolink_link_modal.input.border_radius_round') ?>
                            </label>
                        </div>
                        <div class="col-4">
                            <label class="btn btn-light btn-block <?= ($row->settings->border_radius  ?? null) == 'rounded' ? 'active' : null?>">
                                <input type="radio" name="border_radius" value="rounded" class="custom-control-input" <?= ($row->settings->border_radius  ?? null) == 'rounded' ? 'checked="checked"' : null?> />
                                <i class="fa fa-fw fa-square fa-sm mr-1"></i> <?= l('create_biolink_link_modal.input.border_radius_rounded') ?>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="<?= 'block_border_style_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-border-none fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.border_style') ?></label>
                    <div class="row btn-group-toggle" data-toggle="buttons">
                        <?php foreach(['solid', 'dashed', 'double', 'outset', 'inset'] as $border_style): ?>
                            <div class="col-4">
                                <label class="btn btn-light btn-block <?= ($row->settings->border_style  ?? null) == $border_style ? 'active"' : null?>">
                                    <input type="radio" name="border_style" value="<?= $border_style ?>" class="custom-control-input" <?= ($row->settings->border_style  ?? null) == $border_style ? 'checked="checked"' : null?> />
                                    <?= l('create_biolink_link_modal.input.border_style_' . $border_style) ?>
                                </label>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-block btn-gray-300 my-4" type="button" data-toggle="collapse" data-target="#<?= 'display_settings_container_' . $row->biolink_block_id ?>" aria-expanded="false" aria-controls="<?= 'display_settings_container_' . $row->biolink_block_id ?>">
        <?= l('create_biolink_link_modal.display_settings_header') ?>
    </button>

    <div class="collapse" id="<?= 'display_settings_container_' . $row->biolink_block_id ?>">
        <div <?= $this->user->plan_settings->temporary_url_is_enabled ? null : 'data-toggle="tooltip" title="' . l('global.info_message.plan_feature_no_access') . '"' ?>>
            <div class="<?= $this->user->plan_settings->temporary_url_is_enabled ? null : 'container-disabled' ?>">
                <div class="form-group custom-control custom-switch">
                    <input
                            id="<?= 'link_schedule_' . $row->biolink_block_id ?>"
                            name="schedule" type="checkbox"
                            class="custom-control-input"
                        <?= !empty($row->start_date) && !empty($row->end_date) ? 'checked="checked"' : null ?>
                        <?= $this->user->plan_settings->temporary_url_is_enabled ? null : 'disabled="disabled"' ?>
                    >
                    <label class="custom-control-label" for="<?= 'link_schedule_' . $row->biolink_block_id ?>"><?= l('link.settings.schedule') ?></label>
                    <small class="form-text text-muted"><?= l('link.settings.schedule_help') ?></small>
                </div>
            </div>
        </div>

        <div class="mt-3 schedule_container" style="display: none;">
            <div <?= $this->user->plan_settings->temporary_url_is_enabled ? null : 'data-toggle="tooltip" title="' . l('global.info_message.plan_feature_no_access') . '"' ?>>
                <div class="<?= $this->user->plan_settings->temporary_url_is_enabled ? null : 'container-disabled' ?>">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="<?= 'link_start_date_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-clock fa-sm text-muted mr-1"></i> <?= l('link.settings.start_date') ?></label>
                                <input
                                        id="<?= 'link_start_date_' . $row->biolink_block_id ?>"
                                        type="text"
                                        class="form-control"
                                        name="start_date"
                                        value="<?= \Altum\Date::get($row->start_date, 1) ?>"
                                        placeholder="<?= l('link.settings.start_date') ?>"
                                        autocomplete="off"
                                        data-daterangepicker
                                >
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="<?= 'link_end_date_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-clock fa-sm text-muted mr-1"></i> <?= l('link.settings.end_date') ?></label>
                                <input
                                        id="<?= 'link_end_date_' . $row->biolink_block_id ?>"
                                        type="text"
                                        class="form-control"
                                        name="end_date"
                                        value="<?= \Altum\Date::get($row->end_date, 1) ?>"
                                        placeholder="<?= l('link.settings.end_date') ?>"
                                        autocomplete="off"
                                        data-daterangepicker
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="<?= 'link_display_countries_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-globe fa-sm text-muted mr-1"></i> <?= l('global.countries') ?></label>
            <select id="<?= 'link_display_countries_' . $row->biolink_block_id ?>" name="display_countries[]" class="custom-select" multiple="multiple">
                <?php foreach(get_countries_array() as $country => $country_name): ?>
                    <option value="<?= $country ?>" <?= in_array($country, $row->settings->display_countries ?? []) ? 'selected="selected"' : null ?>><?= $country_name ?></option>
                <?php endforeach ?>
            </select>
            <small class="form-text text-muted"><?= l('create_biolink_link_modal.input.display_countries_help') ?></small>
        </div>

        <div class="form-group">
            <label for="<?= 'link_display_devices_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-laptop fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.display_devices') ?></label>
            <select id="<?= 'link_display_devices_' . $row->biolink_block_id ?>" name="display_devices[]" class="custom-select" multiple="multiple">
                <?php foreach(['desktop', 'tablet', 'mobile'] as $device_type): ?>
                    <option value="<?= $device_type ?>" <?= in_array($device_type, $row->settings->display_devices ?? []) ? 'selected="selected"' : null ?>><?= l('global.device.' . $device_type) ?></option>
                <?php endforeach ?>
            </select>
            <small class="form-text text-muted"><?= l('create_biolink_link_modal.input.display_devices_help') ?></small>
        </div>

        <div class="form-group">
            <label for="<?= 'link_display_languages_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-language fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.display_languages') ?></label>
            <select id="<?= 'link_display_languages_' . $row->biolink_block_id ?>" name="display_languages[]" class="custom-select" multiple="multiple">
                <?php foreach(get_locale_languages_array() as $locale => $language): ?>
                    <option value="<?= $locale ?>" <?= in_array($locale, $row->settings->display_languages ?? []) ? 'selected="selected"' : null ?>><?= $language ?></option>
                <?php endforeach ?>
            </select>
            <small class="form-text text-muted"><?= l('create_biolink_link_modal.input.display_languages_help') ?></small>
        </div>

        <div class="form-group">
            <label for="<?= 'link_display_operating_systems_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-window-restore fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.display_operating_systems') ?></label>
            <select id="<?= 'link_display_operating_systems_' . $row->biolink_block_id ?>" name="display_operating_systems[]" class="custom-select" multiple="multiple">
                <?php foreach(['iOS', 'Android', 'Windows', 'OS X', 'Linux', 'Ubuntu', 'Chrome OS'] as $os_name): ?>
                    <option value="<?= $os_name ?>" <?= in_array($os_name, $row->settings->display_operating_systems ?? []) ? 'selected="selected"' : null ?>><?= $os_name ?></option>
                <?php endforeach ?>
            </select>
            <small class="form-text text-muted"><?= l('create_biolink_link_modal.input.display_operating_systems_help') ?></small>
        </div>
    </div>


    <div class="mt-4">
        <button type="submit" name="submit" class="btn btn-block btn-primary" data-is-ajax><?= l('global.update') ?></button>
    </div>
</form>
