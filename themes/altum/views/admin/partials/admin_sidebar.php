<?php defined('ALTUMCODE') || die() ?>

<section class="admin-sidebar">
    <div class="admin-sidebar-title">
        <a href="<?= url() ?>" class="h3 m-0 text-decoration-none text-truncate" data-logo data-light-value="<?= settings()->main->logo_light != '' ? \Altum\Uploads::get_full_url('logo_light') . settings()->main->logo_light : settings()->main->title ?>" data-light-class="<?= settings()->main->logo_light != '' ? 'img-fluid admin-navbar-logo' : 'admin-navbar-brand text-truncate' ?>" data-dark-value="<?= settings()->main->logo_dark != '' ? \Altum\Uploads::get_full_url('logo_dark') . settings()->main->logo_dark : settings()->main->title ?>" data-dark-class="<?= settings()->main->logo_dark != '' ? 'img-fluid admin-navbar-logo' : 'admin-navbar-brand text-truncate' ?>">
            <?php if(settings()->main->{'logo_' . \Altum\ThemeStyle::get()} != ''): ?>
                <img src="<?= \Altum\Uploads::get_full_url('logo_' . \Altum\ThemeStyle::get()) . settings()->main->{'logo_' . \Altum\ThemeStyle::get()} ?>" class="img-fluid admin-navbar-logo" alt="<?= l('global.accessibility.logo_alt') ?>" />
            <?php else: ?>
                <div class="admin-navbar-brand text-truncate"><?= settings()->main->title ?></div>
            <?php endif ?>
        </a>
    </div>

    <div class="admin-sidebar-links-wrapper">
        <ul class="admin-sidebar-links">
            <li class="<?= \Altum\Router::$controller == 'AdminIndex' ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/') ?>">
                    <i class="fa fa-fw fa-sm fa-tv mr-2"></i> <?= l('admin_index.menu') ?>
                </a>
            </li>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminUsers', 'AdminUserUpdate', 'AdminUserCreate', 'AdminUserView']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/users') ?>">
                    <i class="fa fa-fw fa-sm fa-users mr-2"></i> <?= l('admin_users.menu') ?>
                </a>
            </li>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminUsersLogs']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/users-logs') ?>">
                    <i class="fa fa-fw fa-sm fa-scroll mr-2"></i> <?= l('admin_users_logs.menu') ?>
                </a>
            </li>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminLinks']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/links') ?>">
                    <i class="fa fa-fw fa-sm fa-link mr-2"></i> <?= l('admin_links.menu') ?>
                </a>
            </li>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminBiolinksThemes']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/biolinks-themes') ?>">
                    <i class="fa fa-fw fa-sm fa-palette mr-2"></i> <?= l('admin_biolinks_themes.menu') ?>
                </a>
            </li>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminProjects']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/projects') ?>">
                    <i class="fa fa-fw fa-sm fa-project-diagram mr-2"></i> <?= l('admin_projects.menu') ?>
                </a>
            </li>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminPixels']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/pixels') ?>">
                    <i class="fa fa-fw fa-sm fa-adjust mr-2"></i> <?= l('admin_pixels.menu') ?>
                </a>
            </li>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminQrCodes']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/qr-codes') ?>">
                    <i class="fa fa-fw fa-sm fa-qrcode mr-2"></i> <?= l('admin_qr_codes.menu') ?>
                </a>
            </li>

            <?php if(\Altum\Plugin::is_active('aix')): ?>
                <li class="<?= in_array(\Altum\Router::$controller, ['AdminDocuments']) ? 'active' : null ?>">
                    <a class="nav-link text-truncate" href="<?= url('admin/documents') ?>">
                        <i class="fa fa-fw fa-sm fa-robot mr-2"></i> <?= l('admin_documents.menu') ?>
                    </a>
                </li>

                <li class="<?= in_array(\Altum\Router::$controller, ['AdminImages']) ? 'active' : null ?>">
                    <a class="nav-link text-truncate" href="<?= url('admin/images') ?>">
                        <i class="fa fa-fw fa-sm fa-icons mr-2"></i> <?= l('admin_images.menu') ?>
                    </a>
                </li>

                <li class="<?= in_array(\Altum\Router::$controller, ['AdminTranscriptions']) ? 'active' : null ?>">
                    <a class="nav-link text-truncate" href="<?= url('admin/transcriptions') ?>">
                        <i class="fa fa-fw fa-sm fa-microphone-alt mr-2"></i> <?= l('admin_transcriptions.menu') ?>
                    </a>
                </li>
            <?php endif ?>

            <?php if(\Altum\Plugin::is_active('email-signatures')): ?>
                <li class="<?= in_array(\Altum\Router::$controller, ['AdminSignatures']) ? 'active' : null ?>">
                    <a class="nav-link text-truncate" href="<?= url('admin/signatures') ?>">
                        <i class="fa fa-fw fa-sm fa-file-signature mr-2"></i> <?= l('admin_signatures.menu') ?>
                    </a>
                </li>
            <?php endif ?>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminDomains', 'AdminDomainCreate', 'AdminDomainUpdate']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/domains') ?>">
                    <i class="fa fa-fw fa-sm fa-globe mr-2"></i> <?= l('admin_domains.menu') ?>
                </a>
            </li>

            <?php if(\Altum\Plugin::is_active('teams')): ?>
                <li class="<?= \Altum\Router::$controller == 'AdminTeams' ? 'active' : null ?>">
                    <a class="nav-link text-truncate" href="<?= url('admin/teams') ?>">
                        <i class="fa fa-fw fa-sm fa-user-shield mr-2"></i> <?= l('admin_teams.menu') ?>
                    </a>
                </li>
            <?php endif ?>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminPages', 'AdminPageCreate', 'AdminPageUpdate', 'AdminPagesCategories', 'AdminPagesCategoryCreate', 'AdminPagesCategoryUpdate']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="#admin_sidebar_resources_container" data-toggle="collapse" role="button" aria-expanded="false">
                    <i class="fa fa-fw fa-sm fa-info-circle mr-2"></i> <?= l('admin_resources.menu') ?> <i class="fa fa-fw fa-sm fa-caret-down"></i>
                </a>
            </li>

            <div id="admin_sidebar_resources_container" class="collapse bg-gray-200 rounded <?= in_array(\Altum\Router::$controller, ['AdminPages', 'AdminPageCreate', 'AdminPageUpdate', 'AdminPagesCategories', 'AdminPagesCategoryCreate', 'AdminPagesCategoryUpdate']) ? 'show' : null ?>">
                <li class="<?= in_array(\Altum\Router::$controller, ['AdminPagesCategories', 'AdminPagesCategoryCreate', 'AdminPagesCategoryUpdate']) ? 'active' : null ?>">
                    <a class="nav-link text-truncate" href="<?= url('admin/pages-categories') ?>">
                        <i class="fa fa-fw fa-sm fa-book mr-2"></i> <?= l('admin_pages_categories.menu') ?>
                    </a>
                </li>

                <li class="<?= in_array(\Altum\Router::$controller, ['AdminPages', 'AdminPageCreate', 'AdminPageUpdate']) ? 'active' : null ?>">
                    <a class="nav-link text-truncate" href="<?= url('admin/pages') ?>">
                        <i class="fa fa-fw fa-sm fa-copy mr-2"></i> <?= l('admin_pages.menu') ?>
                    </a>
                </li>
            </div>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminBlogPosts', 'AdminBlogPostCreate', 'AdminBlogPostUpdate', 'AdminBlogPostsCategories', 'AdminBlogPostsCategoryCreate', 'AdminBlogPostsCategoryUpdate']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="#admin_sidebar_blog_container" data-toggle="collapse" role="button" aria-expanded="false">
                    <i class="fa fa-fw fa-sm fa-blog mr-2"></i> <?= l('admin_blog.menu') ?> <i class="fa fa-fw fa-sm fa-caret-down"></i>
                </a>
            </li>

            <div id="admin_sidebar_blog_container" class="collapse bg-gray-200 rounded <?= in_array(\Altum\Router::$controller, ['AdminBlogPosts', 'AdminBlogPostCreate', 'AdminBlogPostUpdate', 'AdminBlogPostsCategories', 'AdminBlogPostsCategoryCreate', 'AdminBlogPostsCategoryUpdate']) ? 'show' : null ?>">
                <li class="<?= in_array(\Altum\Router::$controller, ['AdminBlogPostsCategories', 'AdminBlogPostsCategoryCreate', 'AdminBlogPostsCategoryUpdate']) ? 'active' : null ?>">
                    <a class="nav-link text-truncate" href="<?= url('admin/blog-posts-categories') ?>">
                        <i class="fa fa-fw fa-sm fa-map mr-2"></i> <?= l('admin_blog_posts_categories.menu') ?>
                    </a>
                </li>

                <li class="<?= in_array(\Altum\Router::$controller, ['AdminBlogPosts', 'AdminBlogPostCreate', 'AdminBlogPostUpdate']) ? 'active' : null ?>">
                    <a class="nav-link text-truncate" href="<?= url('admin/blog-posts') ?>">
                        <i class="fa fa-fw fa-sm fa-paste mr-2"></i> <?= l('admin_blog_posts.menu') ?>
                    </a>
                </li>
            </div>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminPlans', 'AdminPlanCreate', 'AdminPlanUpdate']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/plans') ?>">
                    <i class="fa fa-fw fa-sm fa-box-open mr-2"></i> <?= l('admin_plans.menu') ?>
                </a>
            </li>

            <?php if(in_array(settings()->license->type, ['SPECIAL','Extended License'])): ?>
            <li class="<?= in_array(\Altum\Router::$controller, ['AdminCodes', 'AdminCodeCreate', 'AdminCodeUpdate']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/codes') ?>">
                    <i class="fa fa-fw fa-sm fa-tags mr-2"></i> <?= l('admin_codes.menu') ?>
                </a>
            </li>

            <li class="<?= in_array(\Altum\Router::$controller, ['AdminTaxes', 'AdminTaxCreate', 'AdminTaxUpdate']) ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/taxes') ?>">
                    <i class="fa fa-fw fa-sm fa-paperclip mr-2"></i> <?= l('admin_taxes.menu') ?>
                </a>
            </li>

            <li class="<?= \Altum\Router::$controller == 'AdminPayments' ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/payments') ?>">
                    <i class="fa fa-fw fa-sm fa-credit-card mr-2"></i> <?= l('admin_payments.menu') ?>
                </a>
            </li>

                <?php if(\Altum\Plugin::is_active('affiliate')): ?>
                <li class="<?= \Altum\Router::$controller == 'AdminAffiliatesWithdrawals' ? 'active' : null ?>">
                    <a class="nav-link text-truncate" href="<?= url('admin/affiliates-withdrawals') ?>">
                        <i class="fa fa-fw fa-sm fa-wallet mr-2"></i> <?= l('admin_affiliates_withdrawals.menu') ?>
                    </a>
                </li>
                <?php endif ?>
            <?php endif ?>

            <li class="<?= \Altum\Router::$controller == 'AdminStatistics' ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/statistics') ?>">
                    <i class="fa fa-fw fa-sm fa-chart-bar mr-2"></i> <?= l('admin_statistics.menu') ?>
                </a>
            </li>

            <li class="<?= \Altum\Router::$controller == 'AdminApiDocumentation' ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/api-documentation') ?>">
                    <i class="fa fa-fw fa-sm fa-code mr-2"></i> <?= l('admin_api_documentation.menu') ?>
                </a>
            </li>

            <li class="<?= \Altum\Router::$controller == 'AdminPlugins' ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/plugins') ?>">
                    <i class="fa fa-fw fa-sm fa-puzzle-piece mr-2"></i> <?= l('admin_plugins.menu') ?>
                </a>
            </li>

            <li class="<?= \Altum\Router::$controller == 'AdminLanguages' ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/languages') ?>">
                    <i class="fa fa-fw fa-sm fa-language mr-2"></i> <?= l('admin_languages.menu') ?>
                </a>
            </li>

            <li class="<?= \Altum\Router::$controller == 'AdminSettings' ? 'active' : null ?>">
                <a class="nav-link text-truncate" href="<?= url('admin/settings') ?>">
                    <i class="fa fa-fw fa-sm fa-wrench mr-2"></i> <?= l('admin_settings.menu') ?>
                </a>
            </li>
        </ul>

        <hr />

        <ul class="admin-sidebar-links">
            <li>
                <a class="nav-link text-truncate" target="_blank" href="<?= url('dashboard') ?>">
                    <i class="fa fa-fw fa-sm fa-home mr-2"></i> <?= l('dashboard.menu') ?>
                </a>
            </li>

            <li class="dropdown">
                <a class="nav-link text-truncate dropdown-toggle dropdown-toggle-simple" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= get_gravatar($this->user->email) ?>" class="admin-avatar mr-2" loading="lazy" />
                    <?= $this->user->name?>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="<?= url('account') ?>"><i class="fa fa-fw fa-sm fa-wrench mr-2"></i> <?= l('account.menu') ?></a>
                    <a class="dropdown-item" href="<?= url('logout') ?>"><i class="fa fa-fw fa-sm fa-sign-out-alt mr-2"></i> <?= l('global.menu.logout') ?></a>
                </div>
            </li>
        </ul>
    </div>
</section>
