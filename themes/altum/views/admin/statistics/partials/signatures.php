<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<div class="card mb-5">
    <div class="card-body">
        <h2 class="h4"><i class="fa fa-fw fa-file-signature fa-xs text-muted"></i> <?= l('admin_statistics.signatures.header') ?></h2>
        <div class="d-flex flex-column flex-xl-row">
            <div class="mb-2 mb-xl-0 mr-4">
                <span class="font-weight-bold"><?= nr($data->total['signatures']) ?></span> <?= l('admin_statistics.signatures.chart') ?>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="signatures"></canvas>
        </div>
    </div>
</div>

<?php $html = ob_get_clean() ?>

<?php ob_start() ?>
<script>
    'use strict';

    let color = css.getPropertyValue('--primary');
    let color_gradient = null;

    /* Display chart */
    let signatures_chart = document.getElementById('signatures').getContext('2d');
    color_gradient = signatures_chart.createLinearGradient(0, 0, 0, 250);
    color_gradient.addColorStop(0, 'rgba(63, 136, 253, .1)');
    color_gradient.addColorStop(1, 'rgba(63, 136, 253, 0.025)');

    new Chart(signatures_chart, {
        type: 'line',
        data: {
            labels: <?= $data->signatures_chart['labels'] ?>,
            datasets: [
                {
                    label: <?= json_encode(l('admin_statistics.signatures.chart')) ?>,
                    data: <?= $data->signatures_chart['signatures'] ?? '[]' ?>,
                    backgroundColor: color_gradient,
                    borderColor: color,
                    fill: true
                }
            ]
        },
        options: chart_options
    });
</script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
