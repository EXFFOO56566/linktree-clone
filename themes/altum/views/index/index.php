<?php defined('ALTUMCODE') || die() ?>

<div class="index-container">
    <?= $this->views['index_menu'] ?>

    <div class="container mt-8 mb-6">
        <?= \Altum\Alerts::output_alerts() ?>

        <div class="row">
            <div class="col">
                <div class="text-left">
                    <h1 class="index-header mb-4"><?= l('index.header') ?></h1>
                    <p class="index-subheader mb-5"><?= l('index.subheader') ?></p>

                    <div class="d-flex flex-column flex-lg-row">
                        <a href="<?= url('register') ?>" class="btn btn-primary index-button mb-3 mb-lg-0 mr-lg-3"><?= l('index.sign_up') ?></a>
                        <?php //ALTUMCODE:DEMO if(!DEMO): ?>
                        <a href="<?= url('example') ?>" target="_blank" class="btn btn-dark index-button mb-3 mb-lg-0"><?= l('index.example') ?> <i class="fa fa-fw fa-xs fa-external-link-alt"></i></a>
                        <?php //ALTUMCODE:DEMO endif ?>
                    </div>
                </div>
            </div>

            <div class="d-none d-lg-block col">
                <img src="<?= ASSETS_FULL_URL . 'images/hero.png' ?>" class="index-image" loading="lazy" />
            </div>
        </div>
    </div>
</div>

<?php if(settings()->links->biolinks_is_enabled): ?>
    <div class="container mt-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto col-lg-5 mb-4 mb-lg-0">
                        <img src="<?= ASSETS_FULL_URL . 'images/index/bio-link.jpg' ?>" class="index-card-image rounded" loading="lazy" />
                    </div>
                    <div class="col">
                        <div class="bg-primary-100 p-3 w-fit-content rounded">
                            <i class="fa fa-fw fa-users fa-lg text-primary"></i>
                        </div>

                        <h2 class="mt-3"><?= l('index.presentation1.header') ?></h2>
                        <p class="h6 mt-3"><?= l('index.presentation1.subheader') ?></p>

                        <ul class="list-style-none mt-4">
                            <li class="d-flex align-items-center mb-2">
                                <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                                <div><?= l('index.presentation1.feature1') ?></div>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                                <div><?= l('index.presentation1.feature2') ?></div>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                                <div><?= l('index.presentation1.feature3') ?></div>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                                <div><?= l('index.presentation1.feature4') ?></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>


<?php if(settings()->links->shortener_is_enabled): ?>
    <div class="container mt-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto col-lg-5 mb-4 mb-lg-0">
                        <img src="<?= ASSETS_FULL_URL . 'images/index/short-link.png' ?>" class="index-card-image rounded" loading="lazy" />
                    </div>
                    <div class="col">
                        <div class="bg-primary-100 p-3 w-fit-content rounded">
                            <i class="fa fa-fw fa-link fa-lg text-primary"></i>
                        </div>

                        <h2 class="mt-3"><?= l('index.presentation2.header') ?></h2>
                        <p class="h6 mt-3"><?= l('index.presentation2.subheader') ?></p>

                        <ul class="list-style-none mt-4">
                            <li class="d-flex align-items-center mb-2">
                                <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                                <div><?= l('index.presentation2.feature1') ?></div>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                                <div><?= l('index.presentation2.feature2') ?></div>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                                <div><?= l('index.presentation2.feature3') ?></div>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                                <div><?= l('index.presentation2.feature4') ?></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if(settings()->links->qr_codes_is_enabled): ?>
    <div class="container mt-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto col-lg-5 mb-4 mb-lg-0">
                        <img src="<?= ASSETS_FULL_URL . 'images/index/qr-code.jpg' ?>" class="index-card-image rounded" loading="lazy" />
                    </div>
                    <div class="col">
                        <div class="bg-primary-100 p-3 w-fit-content rounded">
                            <i class="fa fa-fw fa-qrcode fa-lg text-primary"></i>
                        </div>

                        <h2 class="mt-3"><?= l('index.presentation3.header') ?></h2>
                        <p class="h6 mt-3"><?= l('index.presentation3.subheader') ?></p>

                        <ul class="list-style-none mt-4">
                            <li class="d-flex align-items-center mb-2">
                                <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                                <div><?= l('index.presentation3.feature1') ?></div>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                                <div><?= l('index.presentation3.feature2') ?></div>
                            </li>
                            <li class="d-flex align-items-center mb-2">
                                <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                                <div><?= l('index.presentation3.feature3') ?></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<div class="container mt-8">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-auto col-lg-5 mb-4 mb-lg-0">
                    <img src="<?= ASSETS_FULL_URL . 'images/index/analytics.jpg' ?>" class="index-card-image rounded" loading="lazy" />
                </div>
                <div class="col">
                    <div class="bg-primary-100 p-3 w-fit-content rounded">
                        <i class="fa fa-fw fa-chart-bar fa-lg text-primary"></i>
                    </div>

                    <h2 class="mt-3"><?= l('index.presentation4.header') ?></h2>
                    <p class="h6 mt-3"><?= l('index.presentation4.subheader') ?></p>

                    <ul class="list-style-none mt-4">
                        <li class="d-flex align-items-center mb-2">
                            <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                            <div><?= l('index.presentation4.feature1') ?></div>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                            <div><?= l('index.presentation4.feature2') ?></div>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                            <div><?= l('index.presentation4.feature3') ?></div>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                            <i class="fa fa-fw fa-sm fa-check-circle text-primary mr-3"></i>
                            <div><?= l('index.presentation4.feature4') ?></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white py-6 mt-8">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                <div class="card border-0">
                    <div class="card-body text-center d-flex flex-column">
                        <span class="font-weight-bold text-muted mb-3"><?= l('index.stats.links') ?></span>
                        <span class="h1"><?= nr($data->total_links, 0, true, true) . '+' ?></span>
                    </div>
                </div>
            </div>

            <?php if(settings()->links->qr_codes_is_enabled): ?>
                <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                    <div class="card border-0">
                        <div class="card-body text-center d-flex flex-column">
                            <span class="font-weight-bold text-muted mb-3"><?= l('index.stats.qr_codes') ?></span>
                            <span class="h1"><?= nr($data->total_qr_codes, 0, true, true) . '+' ?></span>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <div class="col-12 col-lg-3 mb-4 mb-lg-0">
                <div class="card border-0">
                    <div class="card-body text-center d-flex flex-column">
                        <span class="font-weight-bold text-muted mb-3"><?= l('index.stats.track_links') ?></span>
                        <span class="h1"><?= nr($data->total_track_links, 0, true, true) . '+' ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-8">
    <div class="row">
        <?php if(settings()->links->files_is_enabled): ?>
            <div class="col-12 col-lg-4 mb-4">
                <div class="card d-flex flex-column justify-content-between h-100">
                    <div class="card-body">
                        <div class="mb-2 bg-gray-100 p-3 rounded">
                            <i class="fa fa-fw fa-lg fa-file text-gray mr-3"></i>
                            <span class="h5"><?= l('index.file_links.header') ?></span>
                        </div>

                        <span class="text-muted"><?= l('index.file_links.subheader') ?></span>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if(settings()->links->vcards_is_enabled): ?>
            <div class="col-12 col-lg-4 mb-4">
                <div class="card d-flex flex-column justify-content-between h-100">
                    <div class="card-body">
                        <div class="mb-2 bg-gray-100 p-3 rounded">
                            <i class="fa fa-fw fa-lg fa-id-card text-gray mr-3"></i>
                            <span class="h5"><?= l('index.vcard_links.header') ?></span>
                        </div>

                        <span class="text-muted"><?= l('index.vcard_links.subheader') ?></span>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if(settings()->links->events_is_enabled): ?>
            <div class="col-12 col-lg-4 mb-4">
                <div class="card d-flex flex-column justify-content-between h-100">
                    <div class="card-body">
                        <div class="mb-2 bg-gray-100 p-3 rounded">
                            <i class="fa fa-fw fa-lg fa-id-card text-gray mr-3"></i>
                            <span class="h5"><?= l('index.event_links.header') ?></span>
                        </div>

                        <span class="text-muted"><?= l('index.event_links.subheader') ?></span>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if(settings()->tools->is_enabled): ?>
            <div class="col-12 col-lg-4 mb-4">
                <div class="card d-flex flex-column justify-content-between h-100">
                    <div class="card-body">
                        <div class="mb-2 bg-gray-100 p-3 rounded">
                            <i class="fa fa-fw fa-lg fa-id-card text-gray mr-3"></i>
                            <span class="h5"><?= l('index.tools.header') ?></span>
                        </div>

                        <span class="text-muted"><?= sprintf(l('index.tools.subheader'), count(array_filter((array) settings()->tools->available_tools))) ?></span>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if(settings()->links->domains_is_enabled): ?>
            <div class="col-12 col-lg-4 mb-4">
                <div class="card d-flex flex-column justify-content-between h-100">
                    <div class="card-body">
                        <div class="mb-2 bg-gray-100 p-3 rounded">
                            <i class="fa fa-fw fa-lg fa-globe text-gray mr-3"></i>
                            <span class="h5"><?= l('index.domains.header') ?></span>
                        </div>

                        <span class="text-muted"><?= l('index.domains.subheader') ?></span>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <div class="col-12 col-lg-4 mb-4">
            <div class="card d-flex flex-column justify-content-between h-100">
                <div class="card-body">
                    <div class="mb-2 bg-gray-100 p-3 rounded">
                        <i class="fa fa-fw fa-lg fa-project-diagram text-gray mr-3"></i>
                        <span class="h5"><?= l('index.projects.header') ?></span>
                    </div>

                    <span class="text-muted"><?= l('index.projects.subheader') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white py-7 mt-8">
    <div class="container">
        <div class="text-center mb-4">
            <h2><?= l('index.pixels.header') ?></h2>
            <p class="text-muted"><?= l('index.pixels.subheader') ?></p>
        </div>

        <div class="d-flex flex-wrap justify-content-center">
            <?php foreach(require APP_PATH . 'includes/pixels.php' as $item): ?>
                <div class="bg-gray-100 rounded w-fit-content p-3 m-4">
                    <span data-toggle="tooltip" title="<?= $item['name'] ?>"><i class="<?= $item['icon'] ?> fa-fw fa-lg mx-1" style="color: <?= $item['color'] ?>"></i></span>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php if(\Altum\Plugin::is_active('aix') && settings()->aix->documents_is_enabled): ?>
    <div class="container mt-8">
        <div class="card bg-gray-900">
            <div class="card-body py-5 py-lg-6 text-center">
                <span class="h3 text-gray-100"><?= sprintf(l('index.documents'), nr($data->total_documents, 0, true, true)) ?></span>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if(settings()->main->display_index_plans): ?>
<div class="container mt-8">
    <div class="text-center mb-5">
        <h2><?= l('index.pricing.header') ?></h2>
        <p class="text-muted"><?= l('index.pricing.subheader') ?></p>
    </div>

    <?= $this->views['plans'] ?>
</div>
<?php endif ?>

<?php if(\Altum\Plugin::is_active('aix') && settings()->aix->images_is_enabled && settings()->aix->images_display_latest_on_index): ?>
    <div class="container mt-8">
        <div class="text-center mb-4">
            <h3 class="h3"><?= sprintf(l('index.images'), nr($data->total_images, 0, true, true)) ?></h3>
            <p class="text-muted"><?= l('index.images_subheader') ?></p>
        </div>

        <div class="card">
            <div class="card-body">
                <?php $images = db()->orderBy('image_id', 'DESC')->get('images', 16); ?>

                <div class="row">
                    <?php foreach($images as $image): ?>
                        <div class="col-6 col-lg-3 mb-4">
                            <img src="<?= UPLOADS_FULL_URL . 'images/' . $image->image ?>" class="img-fluid rounded" alt="<?= $image->input ?>" data-toggle="tooltip" title="<?= $image->input ?>" />
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>
