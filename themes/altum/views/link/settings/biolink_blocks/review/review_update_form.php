<?php defined('ALTUMCODE') || die() ?>

<form name="update_biolink_" method="post" role="form">
    <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" required="required" />
    <input type="hidden" name="request_type" value="update" />
    <input type="hidden" name="block_type" value="review" />
    <input type="hidden" name="biolink_block_id" value="<?= $row->biolink_block_id ?>" />

    <div class="notification-container"></div>

    <div class="form-group">
        <label for="<?= 'review_title_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-signature fa-sm text-muted mr-1"></i> <?= l('create_biolink_review_modal.title') ?></label>
        <input id="<?= 'review_title_' . $row->biolink_block_id ?>" type="text" name="title" class="form-control" value="<?= $row->settings->title ?>" maxlength="128" required="required" />
    </div>

    <div class="form-group">
        <label for="<?= 'review_description_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-pen fa-sm text-muted mr-1"></i> <?= l('create_biolink_review_modal.description') ?></label>
        <textarea id="<?= 'review_description_' . $row->biolink_block_id ?>" name="description" class="form-control" maxlength="1024" required="required"><?= $row->settings->description ?></textarea>
    </div>

    <div class="form-group">
        <label for="<?= 'review_image_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-image fa-sm text-muted mr-1"></i> <?= l('create_biolink_review_modal.image') ?></label>
        <div data-image-container="image" class="<?= !empty($row->settings->image) ? null : 'd-none' ?>">
            <div class="row">
                <div class="m-1 col-6 col-xl-3">
                    <img src="<?= $row->settings->image ? UPLOADS_FULL_URL . 'block_images/' . $row->settings->image : null ?>" class="img-fluid rounded <?= !empty($row->settings->image) ? null : 'd-none' ?>" loading="lazy" />
                </div>
            </div>
        </div>
        <input id="<?= 'review_image_' . $row->biolink_block_id ?>" type="file" name="image" accept="<?= \Altum\Uploads::array_to_list_format($data->biolink_blocks['review']['whitelisted_image_extensions']) ?>" class="form-control-file altum-file-input" />
        <small class="form-text text-muted"><?= sprintf(l('global.accessibility.whitelisted_file_extensions'), \Altum\Uploads::array_to_list_format($data->biolink_blocks['review']['whitelisted_image_extensions'])) . ' ' . sprintf(l('global.accessibility.file_size_limit'), settings()->links->image_size_limit) ?></small>
    </div>

    <div class="form-group">
        <label for="<?= 'review_author_name_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-user fa-sm text-muted mr-1"></i> <?= l('create_biolink_review_modal.author_name') ?></label>
        <input id="<?= 'review_author_name_' . $row->biolink_block_id ?>" type="text" name="author_name" class="form-control" value="<?= $row->settings->author_name ?>" maxlength="128" required="required" />
    </div>

    <div class="form-group">
        <label for="<?= 'review_author_description_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-user-tag fa-sm text-muted mr-1"></i> <?= l('create_biolink_review_modal.author_description') ?></label>
        <input id="<?= 'review_author_description_' . $row->biolink_block_id ?>" type="text" name="author_description" class="form-control" value="<?= $row->settings->author_description ?>" maxlength="128" />
    </div>

    <div class="form-group">
        <label for="<?= 'review_stars_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-star fa-sm text-muted mr-1"></i> <?= l('create_biolink_review_modal.stars') ?></label>
        <input id="<?= 'review_stars_' . $row->biolink_block_id ?>" type="number" min="1" max="5" name="stars" class="form-control" value="<?= $row->settings->stars ?>" required="required" />
    </div>

    <button class="btn btn-block btn-gray-300 my-4" type="button" data-toggle="collapse" data-target="#<?= 'button_settings_container_' . $row->biolink_block_id ?>" aria-expanded="false" aria-controls="<?= 'button_settings_container_' . $row->biolink_block_id ?>">
        <?= l('create_biolink_link_modal.button_header') ?>
    </button>

    <div class="collapse" id="<?= 'button_settings_container_' . $row->biolink_block_id ?>">
        <div <?= $this->user->plan_settings->custom_colored_links ? null : 'data-toggle="tooltip" title="' . l('global.info_message.plan_feature_no_access') . '"' ?>>
            <div class="<?= $this->user->plan_settings->custom_colored_links ? null : 'container-disabled' ?>">
                <div class="form-group">
                    <label for="<?= 'review_title_color_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-paint-brush fa-sm text-muted mr-1"></i> <?= l('create_biolink_review_modal.title_color') ?></label>
                    <input id="<?= 'review_title_color_' . $row->biolink_block_id ?>" type="hidden" name="title_color" class="form-control" value="<?= $row->settings->title_color ?>" required="required" />
                    <div class="title_color_pickr"></div>
                </div>

                <div class="form-group">
                    <label for="<?= 'review_description_color_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-paint-brush fa-sm text-muted mr-1"></i> <?= l('create_biolink_review_modal.description_color') ?></label>
                    <input id="<?= 'review_description_color_' . $row->biolink_block_id ?>" type="hidden" name="description_color" class="form-control" value="<?= $row->settings->description_color ?>" required="required" />
                    <div class="description_color_pickr"></div>
                </div>

                <div class="form-group">
                    <label for="<?= 'review_author_name_color_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-paint-brush fa-sm text-muted mr-1"></i> <?= l('create_biolink_review_modal.author_name_color') ?></label>
                    <input id="<?= 'review_author_name_color_' . $row->biolink_block_id ?>" type="hidden" name="author_name_color" class="form-control" value="<?= $row->settings->author_name_color ?>" required="required" />
                    <div class="author_name_color_pickr"></div>
                </div>

                <div class="form-group">
                    <label for="<?= 'review_author_description_color_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-paint-brush fa-sm text-muted mr-1"></i> <?= l('create_biolink_review_modal.author_description_color') ?></label>
                    <input id="<?= 'review_author_description_color_' . $row->biolink_block_id ?>" type="hidden" name="author_description_color" class="form-control" value="<?= $row->settings->author_description_color ?>" required="required" />
                    <div class="author_description_color_pickr"></div>
                </div>

                <div class="form-group">
                    <label for="<?= 'review_stars_color_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-paint-brush fa-sm text-muted mr-1"></i> <?= l('create_biolink_review_modal.stars_color') ?></label>
                    <input id="<?= 'review_stars_color_' . $row->biolink_block_id ?>" type="hidden" name="stars_color" class="form-control" value="<?= $row->settings->stars_color ?>" required="required" />
                    <div class="stars_color_pickr"></div>
                </div>

                <div class="form-group">
                    <label for="<?= 'review_background_color_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-fill fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.background_color') ?></label>
                    <input id="<?= 'review_background_color_' . $row->biolink_block_id ?>" type="hidden" name="background_color" class="form-control" value="<?= $row->settings->background_color ?>" required="required" />
                    <div class="background_color_pickr"></div>
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
                    <label for="<?= 'review_border_width_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-border-style fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.border_width') ?></label>
                    <input id="<?= 'review_border_width_' . $row->biolink_block_id ?>" type="range" min="0" max="5" class="form-control" name="border_width" value="<?= $row->settings->border_width ?>" required="required" />
                </div>

                <div class="form-group">
                    <label for="<?= 'review_border_color_' . $row->biolink_block_id ?>"><i class="fa fa-fw fa-fill fa-sm text-muted mr-1"></i> <?= l('create_biolink_link_modal.input.border_color') ?></label>
                    <input id="<?= 'review_border_color_' . $row->biolink_block_id ?>" type="hidden" name="border_color" class="form-control" value="<?= $row->settings->border_color ?>" required="required" />
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
