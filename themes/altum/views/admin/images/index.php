<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex flex-column flex-md-row justify-content-between mb-4">
    <h1 class="h3 mb-3 mb-md-0"><i class="fa fa-fw fa-xs fa-icons text-primary-900 mr-2"></i> <?= l('admin_images.header') ?></h1>

    <div class="d-flex position-relative">
        <div class="">
            <div class="dropdown">
                <button type="button" class="btn btn-gray-300 dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport" data-tooltip title="<?= l('global.export') ?>">
                    <i class="fa fa-fw fa-sm fa-download"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-right d-print-none">
                    <a href="<?= url('admin/images?' . $data->filters->get_get() . '&export=csv') ?>" target="_blank" class="dropdown-item">
                        <i class="fa fa-fw fa-sm fa-file-csv mr-1"></i> <?= sprintf(l('global.export_to'), 'CSV') ?>
                    </a>
                    <a href="<?= url('admin/images?' . $data->filters->get_get() . '&export=json') ?>" target="_blank" class="dropdown-item">
                        <i class="fa fa-fw fa-sm fa-file-code mr-1"></i> <?= sprintf(l('global.export_to'), 'JSON') ?>
                    </a>
                    <a href="#" onclick="window.print();return false;" class="dropdown-item">
                        <i class="fa fa-fw fa-sm fa-file-pdf mr-1"></i> <?= sprintf(l('global.export_to'), 'PDF') ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="ml-3">
            <div class="dropdown">
                <button type="button" class="btn <?= count($data->filters->get) ? 'btn-secondary' : 'btn-gray-300' ?> filters-button dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport" data-tooltip title="<?= l('global.filters.header') ?>">
                    <i class="fa fa-fw fa-sm fa-filter"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-right filters-dropdown">
                    <div class="dropdown-header d-flex justify-content-between">
                        <span class="h6 m-0"><?= l('global.filters.header') ?></span>

                        <?php if(count($data->filters->get)): ?>
                            <a href="<?= url('admin/images') ?>" class="text-muted"><?= l('global.filters.reset') ?></a>
                        <?php endif ?>
                    </div>

                    <div class="dropdown-divider"></div>

                    <form action="" method="get" role="form">
                        <div class="form-group px-4">
                            <label for="filters_search" class="small"><?= l('global.filters.search') ?></label>
                            <input type="search" name="search" id="filters_search" class="form-control form-control-sm" value="<?= $data->filters->search ?>" />
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_search_by" class="small"><?= l('global.filters.search_by') ?></label>
                            <select name="search_by" id="filters_search_by" class="custom-select custom-select-sm">
                                <option value="name" <?= $data->filters->search_by == 'name' ? 'selected="selected"' : null ?>><?= l('global.name') ?></option>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_style" class="small"><?= l('images.style') ?></label>
                            <select name="style" id="filters_style" class="custom-select custom-select-sm">
                                <option value=""><?= l('global.filters.all') ?></option>
                                <?php foreach($data->ai_images_styles as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= isset($data->filters->filters['style']) && $data->filters->filters['style'] == $key ? 'selected="selected"' : null ?>><?= l('images.style.' . $key) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_artist" class="small"><?= l('images.artist') ?></label>
                            <select name="artist" id="filters_artist" class="custom-select custom-select-sm">
                                <option value=""><?= l('global.filters.all') ?></option>
                                <?php foreach(settings()->aix->images_available_artists as $artist): ?>
                                    <option value="<?= $artist ?>" <?= isset($data->filters->filters['artist']) && $data->filters->filters['artist'] == $artist ? 'selected="selected"' : null ?>><?= $artist ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_lighting" class="small"><?= l('images.lighting') ?></label>
                            <select name="lighting" id="filters_lighting" class="custom-select custom-select-sm">
                                <option value=""><?= l('global.filters.all') ?></option>
                                <?php foreach($data->ai_images_lighting as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= isset($data->filters->filters['lighting']) && $data->filters->filters['lighting'] == $key ? 'selected="selected"' : null ?>><?= l('images.lighting.' . $key); ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_mood" class="small"><?= l('images.mood') ?></label>
                            <select name="mood" id="filters_mood" class="custom-select custom-select-sm">
                                <option value=""><?= l('global.filters.all') ?></option>
                                <?php foreach($data->ai_images_moods as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= isset($data->filters->filters['mood']) && $data->filters->filters['mood'] == $key ? 'selected="selected"' : null ?>><?= l('images.mood.' . $key); ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_size" class="small"><?= l('images.size') ?></label>
                            <select name="size" id="filters_size" class="custom-select custom-select-sm">
                                <option value=""><?= l('global.filters.all') ?></option>
                                <?php foreach(['256x256', '512x512', '1024x1024'] as $key): ?>
                                    <option value="<?= $key ?>" <?= isset($data->filters->filters['size']) && $data->filters->filters['size'] == $key ? 'selected="selected"' : null ?>><?= $key ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_order_by" class="small"><?= l('global.filters.order_by') ?></label>
                            <select name="order_by" id="filters_order_by" class="custom-select custom-select-sm">
                                <option value="datetime" <?= $data->filters->order_by == 'datetime' ? 'selected="selected"' : null ?>><?= l('global.filters.order_by_datetime') ?></option>
                                <option value="last_datetime" <?= $data->filters->order_by == 'last_datetime' ? 'selected="selected"' : null ?>><?= l('global.filters.order_by_last_datetime') ?></option>
                                <option value="name" <?= $data->filters->order_by == 'name' ? 'selected="selected"' : null ?>><?= l('global.name') ?></option>
                                <option value="words" <?= $data->filters->order_by == 'words' ? 'selected="selected"' : null ?>><?= l('images.words') ?></option>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_order_type" class="small"><?= l('global.filters.order_type') ?></label>
                            <select name="order_type" id="filters_order_type" class="custom-select custom-select-sm">
                                <option value="ASC" <?= $data->filters->order_type == 'ASC' ? 'selected="selected"' : null ?>><?= l('global.filters.order_type_asc') ?></option>
                                <option value="DESC" <?= $data->filters->order_type == 'DESC' ? 'selected="selected"' : null ?>><?= l('global.filters.order_type_desc') ?></option>
                            </select>
                        </div>

                        <div class="form-group px-4">
                            <label for="filters_results_per_page" class="small"><?= l('global.filters.results_per_page') ?></label>
                            <select name="results_per_page" id="filters_results_per_page" class="custom-select custom-select-sm">
                                <?php foreach($data->filters->allowed_results_per_page as $key): ?>
                                    <option value="<?= $key ?>" <?= $data->filters->results_per_page == $key ? 'selected="selected"' : null ?>><?= $key ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group px-4 mt-4">
                            <button type="submit" name="submit" class="btn btn-sm btn-primary btn-block"><?= l('global.submit') ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="ml-3">
            <button id="bulk_enable" type="button" class="btn btn-gray-300" data-toggle="tooltip" title="<?= l('global.bulk_actions') ?>"><i class="fa fa-fw fa-sm fa-list"></i></button>

            <div id="bulk_group" class="btn-group d-none" role="group">
                <div class="btn-group" role="group">
                    <button id="bulk_actions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                        <?= l('global.bulk_actions') ?> <span id="bulk_counter" class="d-none"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="bulk_actions">
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#bulk_delete_modal"><?= l('global.delete') ?></a>
                    </div>
                </div>

                <button id="bulk_disable" type="button" class="btn btn-secondary" data-toggle="tooltip" title="<?= l('global.close') ?>"><i class="fa fa-fw fa-times"></i></button>
            </div>
        </div>
    </div>
</div>

<?= \Altum\Alerts::output_alerts() ?>

<form id="table" action="<?= SITE_URL . 'admin/images/bulk' ?>" method="post" role="form">
    <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />
    <input type="hidden" name="type" value="" data-bulk-type />

    <div class="table-responsive table-custom-container">
    <table class="table table-custom">
        <thead>
        <tr>
            <th data-bulk-table class="d-none">
                <div class="custom-control custom-checkbox">
                    <input id="bulk_select_all" type="checkbox" class="custom-control-input" />
                    <label class="custom-control-label" for="bulk_select_all"></label>
                </div>
            </th>
            <th><?= l('global.user') ?></th>
            <th><?= l('images.image') ?></th>
            <th><?= l('images.size') ?></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($data->images as $row): ?>
            <?php //ALTUMCODE:DEMO if(DEMO) {$row->user_email = 'hidden@demo.com'; $row->user_name = $row->name = 'hidden on demo';} ?>

            <tr>
                <td data-bulk-table class="d-none">
                    <div class="custom-control custom-checkbox">
                        <input id="selected_image_id_<?= $row->image_id ?>" type="checkbox" class="custom-control-input" name="selected[]" value="<?= $row->image_id ?>" />
                        <label class="custom-control-label" for="selected_image_id_<?= $row->image_id ?>"></label>
                    </div>
                </td>
                <td class="text-nowrap">
                    <div class="d-flex">
                        <a href="<?= url('admin/user-view/' . $row->user_id) ?>">
                            <img src="<?= get_gravatar($row->user_email) ?>" class="user-avatar rounded-circle mr-3" alt="" />
                        </a>

                        <div class="d-flex flex-column">
                            <div>
                                <a href="<?= url('admin/user-view/' . $row->user_id) ?>"><?= $row->user_name ?></a>
                            </div>

                            <span class="text-muted"><?= $row->user_email ?></span>
                        </div>
                    </div>
                </td>

                <td class="text-nowrap">
                    <div class="d-flex align-items-center">
                        <a href="<?= UPLOADS_FULL_URL . 'images/' . $row->image ?>" target="_blank">
                            <img src="<?= UPLOADS_FULL_URL . 'images/' . $row->image ?>" class="img-fluid rounded mr-3" style="width: 50px; height: 50px;min-width: 50px; min-height: 50px;" data-toggle="tooltip" title="<?= l('global.view') ?>" alt="<?= $row->input ?>" />
                        </a>

                        <div class="d-flex flex-column">
                            <span><?= $row->name ?></span>
                            <small class="text-muted" data-toggle="tooltip" title="<?= string_truncate($row->input, 256) ?>"><?= string_truncate($row->input, 32) ?></small>
                        </div>
                    </div>
                </td>

                <td class="text-nowrap">
                    <?= $row->size ?>
                </td>

                <td class="text-nowrap">
                    <div class="d-flex align-items-center">
                        <span class="mr-2" data-toggle="tooltip" data-html="true" title="<?= sprintf(l('global.datetime_tooltip'), '<br />' . \Altum\Date::get($row->datetime, 2) . '<br /><small>' . \Altum\Date::get($row->datetime, 3) . '</small>') ?>">
                            <i class="fa fa-fw fa-clock text-muted"></i>
                        </span>

                        <span class="mr-2" data-toggle="tooltip" data-html="true" title="<?= sprintf(l('global.last_datetime_tooltip'), ($row->last_datetime ? '<br />' . \Altum\Date::get($row->last_datetime, 2) . '<br /><small>' . \Altum\Date::get($row->last_datetime, 3) . '</small>' : '-')) ?>">
                            <i class="fa fa-fw fa-history text-muted"></i>
                        </span>
                    </div>
                </td>
                <td>
                    <div class="d-flex justify-content-end">
                        <?= include_view(THEME_PATH . 'views/admin/images/admin_image_dropdown_button.php', ['id' => $row->image_id, 'resource_name' => $row->name, 'image' => $row->image, 'image_url' => UPLOADS_FULL_URL . 'images/' . $row->image]) ?>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>

        </tbody>
    </table>
</div>
</form>

<div class="mt-3"><?= $data->pagination ?></div>

<?php require THEME_PATH . 'views/admin/partials/js_bulk.php' ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/admin/partials/bulk_delete_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/universal_delete_modal_url.php', [
    'name' => 'image',
    'resource_id' => 'image_id',
    'has_dynamic_resource_name' => true,
    'path' => 'admin/images/delete/'
]), 'modals'); ?>
