<?php defined('ALTUMCODE') || die() ?>

<div class="app-sidebar">
    <div class="app-sidebar-title text-truncate">
        <a href="<?= url() ?>" data-logo data-light-value="<?= settings()->main->logo_light != '' ? \Altum\Uploads::get_full_url('logo_light') . settings()->main->logo_light : settings()->main->title ?>" data-light-class="<?= settings()->main->logo_light != '' ? 'img-fluid navbar-logo' : '' ?>" data-dark-value="<?= settings()->main->logo_dark != '' ? \Altum\Uploads::get_full_url('logo_dark') . settings()->main->logo_dark : settings()->main->title ?>" data-dark-class="<?= settings()->main->logo_dark != '' ? 'img-fluid navbar-logo' : '' ?>">
            <?php if(settings()->main->{'logo_' . \Altum\ThemeStyle::get()} != ''): ?>
                <img src="<?= \Altum\Uploads::get_full_url('logo_' . \Altum\ThemeStyle::get()) . settings()->main->{'logo_' . \Altum\ThemeStyle::get()} ?>" class="img-fluid navbar-logo" alt="<?= l('global.accessibility.logo_alt') ?>" />
            <?php else: ?>
                <?= settings()->main->title ?>
            <?php endif ?>
        </a>
    </div>

    <div class="app-sidebar-links-wrapper flex-grow-1">
        <ul class="app-sidebar-links">
            <?php if(\Altum\Authentication::check()): ?>
                <li class="<?= \Altum\Router::$controller == 'Dashboard' ? 'active' : null ?>">
                    <a href="<?= url('dashboard') ?>"><i class="fa fa-fw fa-sm fa-th mr-2"></i> <?= l('dashboard.menu') ?></a>
                </li>

                <?php if(settings()->links->biolinks_is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'Links' && ($_GET['type'] ?? 'link') == 'biolink' ? 'active' : null ?>">
                        <a href="<?= url('links?type=biolink') ?>"><i class="fa fa-fw fa-sm fa-hashtag mr-2"></i> <?= l('links.menu.biolinks') ?></a>
                    </li>
                <?php endif ?>

                <?php if(settings()->links->shortener_is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'Links' && ($_GET['type'] ?? 'link') == 'link' ? 'active' : null ?>">
                        <a href="<?= url('links?type=link') ?>"><i class="fa fa-fw fa-sm fa-link mr-2"></i> <?= l('links.menu.links') ?></a>
                    </li>
                <?php endif ?>

                <?php if(settings()->links->files_is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'Links' && ($_GET['type'] ?? 'link') == 'file' ? 'active' : null ?>">
                        <a href="<?= url('links?type=file') ?>"><i class="fa fa-fw fa-sm fa-file mr-2"></i> <?= l('links.menu.files') ?></a>
                    </li>
                <?php endif ?>

                <?php if(settings()->links->vcards_is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'Links' && ($_GET['type'] ?? 'link') == 'vcard' ? 'active' : null ?>">
                        <a href="<?= url('links?type=vcard') ?>"><i class="fa fa-fw fa-sm fa-id-card mr-2"></i> <?= l('links.menu.vcards') ?></a>
                    </li>
                <?php endif ?>

                <?php if(settings()->links->events_is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'Links' && ($_GET['type'] ?? 'link') == 'event' ? 'active' : null ?>">
                        <a href="<?= url('links?type=event') ?>"><i class="fa fa-fw fa-sm fa-calendar mr-2"></i> <?= l('links.menu.events') ?></a>
                    </li>
                <?php endif ?>

                <?php if(settings()->links->qr_codes_is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'QrCodes' ? 'active' : null ?>">
                        <a href="<?= url('qr-codes') ?>"><i class="fa fa-fw fa-sm fa-qrcode mr-2"></i> <?= l('qr_codes.menu') ?></a>
                    </li>
                <?php endif ?>

                <?php if(\Altum\Plugin::is_active('aix') && settings()->aix->documents_is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'Documents' ? 'active' : null ?>">
                        <a href="<?= url('documents') ?>"><i class="fa fa-fw fa-sm fa-robot mr-2"></i> <?= l('documents.menu') ?></a>
                    </li>
                <?php endif ?>

                <?php if(\Altum\Plugin::is_active('aix') && settings()->aix->images_is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'Images' ? 'active' : null ?>">
                        <a href="<?= url('images') ?>"><i class="fa fa-fw fa-sm fa-icons mr-2"></i> <?= l('images.menu') ?></a>
                    </li>
                <?php endif ?>

                <?php if(\Altum\Plugin::is_active('aix') && settings()->aix->transcriptions_is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'Transcriptions' ? 'active' : null ?>">
                        <a href="<?= url('transcriptions') ?>"><i class="fa fa-fw fa-sm fa-microphone-alt mr-2"></i> <?= l('transcriptions.menu') ?></a>
                    </li>
                <?php endif ?>

                <?php if(\Altum\Plugin::is_active('email-signatures') && settings()->signatures->is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'Signatures' ? 'active' : null ?>">
                        <a href="<?= url('signatures') ?>"><i class="fa fa-fw fa-sm fa-file-signature mr-2"></i> <?= l('signatures.menu') ?></a>
                    </li>
                <?php endif ?>
            <?php endif ?>

            <?php if(settings()->tools->is_enabled && (settings()->tools->access == 'everyone' || (settings()->tools->access == 'users' && \Altum\Authentication::check()))): ?>
                <li class="<?= \Altum\Router::$controller == 'Tools' ? 'active' : null ?>">
                    <a href="<?= url('tools') ?>"><i class="fa fa-fw fa-sm fa-tools mr-2"></i> <?= l('tools.menu') ?></a>
                </li>
            <?php endif ?>

            <div class="divider-wrapper">
                <div class="divider"></div>
            </div>

            <?php if(\Altum\Authentication::check()): ?>

                <?php if(settings()->links->domains_is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'Domains' ? 'active' : null ?>">
                        <a href="<?= url('domains') ?>"><i class="fa fa-fw fa-sm fa-globe mr-2"></i> <?= l('domains.menu') ?></a>
                    </li>
                <?php endif ?>

                <li class="<?= \Altum\Router::$controller == 'Pixels' ? 'active' : null ?>">
                    <a href="<?= url('pixels') ?>"><i class="fa fa-fw fa-sm fa-adjust mr-2"></i> <?= l('pixels.menu') ?></a>
                </li>

                <li class="<?= \Altum\Router::$controller == 'Projects' ? 'active' : null ?>">
                    <a href="<?= url('projects') ?>"><i class="fa fa-fw fa-sm fa-project-diagram mr-2"></i> <?= l('projects.menu') ?></a>
                </li>

                <?php if(settings()->links->biolinks_is_enabled): ?>
                    <li class="<?= \Altum\Router::$controller == 'Data' ? 'active' : null ?>">
                        <a href="<?= url('data') ?>"><i class="fa fa-fw fa-sm fa-database mr-2"></i> <?= l('data.menu') ?></a>
                    </li>

                    <?php if(\Altum\Plugin::is_active('payment-blocks')): ?>
                        <li class="<?= \Altum\Router::$controller == 'PaymentProcessors' ? 'active' : null ?>">
                            <a href="<?= url('payment-processors') ?>"><i class="fa fa-fw fa-sm fa-credit-card mr-2"></i> <?= l('payment_processors.menu') ?></a>
                        </li>
                        <li class="<?= \Altum\Router::$controller == 'GuestsPayments' ? 'active' : null ?>">
                            <a href="<?= url('guests-payments') ?>"><i class="fa fa-fw fa-sm fa-coins mr-2"></i> <?= l('guests_payments.menu') ?></a>
                        </li>
                    <?php endif ?>
                <?php endif ?>
            <?php endif ?>

            <?php if(settings()->links->biolinks_is_enabled && settings()->links->directory_is_enabled && (settings()->links->directory_access == 'everyone' || (settings()->links->directory_access == 'users' && \Altum\Authentication::check()))): ?>
                <li>
                    <a href="<?= url('directory') ?>"><i class="fa fa-fw fa-sm fa-sitemap mr-2"></i> <?= l('directory.menu') ?></a>
                </li>
            <?php endif ?>

            <?php foreach($data->pages as $data): ?>
                <li>
                    <a href="<?= $data->url ?>" target="<?= $data->target ?>"><?= $data->title ?></a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>

    <?php if(\Altum\Authentication::check()): ?>

        <div class="app-sidebar-footer dropdown">
            <a href="#" class="dropdown-toggle dropdown-toggle-simple" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="d-flex align-items-center app-sidebar-footer-block">
                    <img src="<?= get_gravatar($this->user->email) ?>" class="app-sidebar-avatar mr-3" loading="lazy" />

                    <div class="app-sidebar-footer-text d-flex flex-column text-truncate">
                        <span class="text-truncate"><?= $this->user->name ?></span>
                        <small class="text-truncate"><?= $this->user->email ?></small>
                    </div>
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <?php if(!\Altum\Teams::is_delegated()): ?>
                    <?php if(\Altum\Authentication::is_admin()): ?>
                        <a class="dropdown-item" href="<?= url('admin') ?>"><i class="fa fa-fw fa-sm fa-fingerprint mr-2"></i> <?= l('global.menu.admin') ?></a>
                        <div class="dropdown-divider"></div>
                    <?php endif ?>

                    <a class="dropdown-item" href="<?= url('account') ?>"><i class="fa fa-fw fa-sm fa-wrench mr-2"></i> <?= l('account.menu') ?></a>

                    <a class="dropdown-item" href="<?= url('account-plan') ?>"><i class="fa fa-fw fa-sm fa-box-open mr-2"></i> <?= l('account_plan.menu') ?></a>

                    <?php if(settings()->payment->is_enabled): ?>
                        <a class="dropdown-item" href="<?= url('account-payments') ?>"><i class="fa fa-fw fa-sm fa-dollar-sign mr-2"></i> <?= l('account_payments.menu') ?></a>

                        <?php if(\Altum\Plugin::is_active('affiliate') && settings()->affiliate->is_enabled): ?>
                            <a class="dropdown-item" href="<?= url('referrals') ?>"><i class="fa fa-fw fa-sm fa-wallet mr-2"></i> <?= l('referrals.menu') ?></a>
                        <?php endif ?>
                    <?php endif ?>

                    <a class="dropdown-item" href="<?= url('account-api') ?>"><i class="fa fa-fw fa-sm fa-code mr-2"></i> <?= l('account_api.menu') ?></a>

                    <?php if(\Altum\Plugin::is_active('teams')): ?>
                        <a class="dropdown-item" href="<?= url('teams-system') ?>"><i class="fa fa-fw fa-sm fa-user-shield mr-2"></i> <?= l('teams_system.menu') ?></a>
                    <?php endif ?>
                <?php endif ?>

                <a class="dropdown-item" href="<?= url('logout') ?>"><i class="fa fa-fw fa-sm fa-sign-out-alt mr-2"></i> <?= l('global.menu.logout') ?></a>
            </div>
        </div>

    <?php else: ?>

        <ul class="app-sidebar-links">
            <li>
                <a class="nav-link" href="<?= url('login') ?>"><i class="fa fa-fw fa-sm fa-sign-in-alt mr-2"></i> <?= l('login.menu') ?></a>
            </li>

            <?php if(settings()->users->register_is_enabled): ?>
                <li><a class="nav-link" href="<?= url('register') ?>"><i class="fa fa-fw fa-sm fa-user-plus mr-2"></i> <?= l('register.menu') ?></a></li>
            <?php endif ?>
        </ul>

    <?php endif ?>
</div>
