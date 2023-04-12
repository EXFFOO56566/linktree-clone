<?php defined('ALTUMCODE') || die() ?>

<div class="container">
    <?= \Altum\Alerts::output_alerts() ?>

    <nav aria-label="breadcrumb">
        <ol class="custom-breadcrumbs small">
            <li><a href="<?= url() ?>"><?= l('index.breadcrumb') ?></a> <i class="fa fa-fw fa-angle-right"></i></li>
            <li class="active" aria-current="page"><?= l('plan.breadcrumb') ?></li>
        </ol>
    </nav>

    <?php if(\Altum\Authentication::check() && $this->user->plan_is_expired && $this->user->plan_id != 'free'): ?>
        <div class="alert alert-info" role="alert">
            <?= l('global.info_message.user_plan_is_expired') ?>
        </div>
    <?php endif ?>

    <?php if($data->type == 'new'): ?>

        <h1 class="h3"><?= l('plan.header_new') ?></h1>
        <span class="text-muted"><?= l('plan.subheader_new') ?></span>

    <?php elseif($data->type == 'renew'): ?>

        <h1 class="h3"><?= l('plan.header_renew') ?></h1>
        <span class="text-muted"><?= l('plan.subheader_renew') ?></span>

    <?php elseif($data->type == 'upgrade'): ?>

        <h1 class="h3"><?= l('plan.header_upgrade') ?></h1>
        <span class="text-muted"><?= l('plan.subheader_upgrade') ?></span>

    <?php endif ?>

    <div class="mt-5">
        <?= $this->views['plans'] ?>
    </div>

    <div class="mt-5">
        <h1 class="h3"><?= l('plan.why.header') ?></h1>
        <span class="text-muted"><?= l('plan.why.subheader') ?></span>

        <div class="mt-4 row">
            <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <span class="h5"><?= l('plan.why.one.header') ?></span>
                            <span class="text-muted"><?= l('plan.why.one.subheader') ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <span class="h5"><?= l('plan.why.two.header') ?></span>
                            <span class="text-muted"><?= l('plan.why.two.subheader') ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <span class="h5"><?= l('plan.why.three.header') ?></span>
                            <span class="text-muted"><?= l('plan.why.three.subheader') ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h1 class="h3"><?= l('plan.faq.header') ?></h1>

        <div class="card mt-4">
            <div class="card-body">
                <div>
                    <h2 class="h5"><?= l('plan.faq.one.header') ?></h2>
                    <p class="text-muted"><?= l('plan.faq.one.text') ?></p>
                </div>

                <div class="mt-5">
                    <h2 class="h5"><?= l('plan.faq.two.header') ?></h2>
                    <p class="text-muted"><?= l('plan.faq.two.text') ?></p>
                </div>

                <div class="mt-5">
                    <h2 class="h5"><?= l('plan.faq.three.header') ?></h2>
                    <p class="text-muted"><?= l('plan.faq.three.text') ?></p>
                </div>

                <div class="mt-5">
                    <h2 class="h5"><?= l('plan.faq.four.header') ?></h2>
                    <p class="text-muted"><?= l('plan.faq.four.text') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
