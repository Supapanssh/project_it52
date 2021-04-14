<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "plugins/fontawesome-free/css/all.min.css",
        "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",
        "plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css",
        "plugins/icheck-bootstrap/icheck-bootstrap.min.css",
        "plugins/jqvmap/jqvmap.min.css",
        "dist/css/adminlte.min.css",
        "plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
        "plugins/daterangepicker/daterangepicker.css",
        "plugins/summernote/summernote-bs4.min.css",
        "plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
        "plugins/datatables-responsive/css/responsive.bootstrap4.min.css",
        "plugins/datatables-buttons/css/buttons.bootstrap4.min.css",
        'css/site.css',
    ];
    public $js = [
        "https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js",
        "plugins/jquery-ui/jquery-ui.min.js",
        "plugins/bootstrap/js/bootstrap.bundle.min.js",
        "plugins/chart.js/Chart.min.js",
        "plugins/sparklines/sparkline.js",
        "plugins/jqvmap/jquery.vmap.min.js",
        "plugins/jqvmap/maps/jquery.vmap.usa.js",
        "plugins/jquery-knob/jquery.knob.min.js",
        "plugins/moment/moment.min.js",
        "plugins/daterangepicker/daterangepicker.js",
        "plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js",
        "plugins/summernote/summernote-bs4.min.js",
        "plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
        "dist/js/adminlte.js",
        "plugins/datatables/jquery.dataTables.min.js",
        "plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
        "plugins/datatables-responsive/js/dataTables.responsive.min.js",
        "plugins/datatables-responsive/js/responsive.bootstrap4.min.js",
        "plugins/datatables-buttons/js/dataTables.buttons.min.js",
        "plugins/datatables-buttons/js/buttons.bootstrap4.min.js",
        "plugins/jszip/jszip.min.js",
        "plugins/pdfmake/pdfmake.min.js",
        "plugins/pdfmake/vfs_fonts.js",
        "plugins/datatables-buttons/js/buttons.html5.min.js",
        "plugins/datatables-buttons/js/buttons.print.min.js",
        "plugins/datatables-buttons/js/buttons.colVis.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68bi/pdfmake.js",
        "js/pdfmake.js",
        "https://code.highcharts.com/highcharts.js",
        "https://code.highcharts.com/modules/bullet.js",
        "https://code.highcharts.com/modules/exporting.js",
        "https://code.highcharts.com/modules/export-data.js",
        "https://code.highcharts.com/modules/accessibility.js",
        "https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js",
        "js/init.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
