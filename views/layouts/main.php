<?php

use app\models\SiteInfo;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="icon" href="<?= SiteInfo::web() ?>dist/img/scholarship.png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= SiteInfo::web() ?>css/custom.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=K2D:wght@300;400&display=swap" rel="stylesheet">
    <style>
        .linespace {
            margin-bottom: 1rem;
        }

        text.highcharts-credits {
            display: none;
        }

        * {
            font-family: 'k2d', sans-serif;
        }
    </style>

    <!-- jQuery -->
    <script src="<?= SiteInfo::web() ?>plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="<?= SiteInfo::web() ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= SiteInfo::web() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= SiteInfo::web() ?>plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= SiteInfo::web() ?>plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?= SiteInfo::web() ?>plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= SiteInfo::web() ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= SiteInfo::web() ?>plugins/moment/moment.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= SiteInfo::web() ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= SiteInfo::web() ?>plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= SiteInfo::web() ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= SiteInfo::web() ?>dist/js/adminlte.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?= SiteInfo::web() ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/jszip/jszip.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= SiteInfo::web() ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68bi/pdfmake.js"></script>
    <script src="<?= SiteInfo::web() ?>js/pdfmake.js"></script>
    <script src="<?= SiteInfo::web() ?>js/ChartLibMy.js"></script>
    <script src="<?= SiteInfo::web() ?>js/jquery.canvasjs.min.js"></script>
</head>

<body class="sidebar-mini sidebar-collapse">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->render('navbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->render('sidebar') ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $this->render('content', ['content' => $content]) ?>

        <!-- Main Footer -->
        <?= $this->render('footer') ?>
    </div>
    <script>
        pageMargins = [35, 35, 35, 35];
        defaultStyle = {
            font: 'THSarabun',
            fontSize: 16,
            margin: [0, 5, 0, 5] //left,top,right,bottom
        };
        header = {
            fontSize: 18,
            bold: true,
            margin: [0, 5, 0, 5] //left,top,right,bottom
        };
        bigHeader = {
            fontSize: 20,
            bold: true,
            alignment: "justify"
        };
        subheader = {
            fontSize: 16,
            bold: true,
            margin: [0, 5, 0, 5] //left,top,right,bottom
        };
        dotUnderLine = {
            fontSize: 16,
            // decoration: 'underline',
            // decorationStyle: 'dashed',
            decorationColor: 'black',
        };
        subheaderNoMargin = {
            fontSize: 16,
            bold: true,
            margin: [0, 0, 0, 0] //left,top,right,bottom
        };
        pdfMake.fonts = {
            THSarabun: {
                normal: 'THSarabun.ttf',
                bold: 'THSarabun-Bold.ttf',
                italics: 'THSarabun-Italic.ttf',
                bolditalics: 'THSarabun-BoldItalic.ttf'
            }
        }

        $(document).ready(function() {
            $('.data-table tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
            });

            var table = $('.data-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
                language: {
                    "sSearch": "ค้นหา",
                    "infoFiltered": "",
                    "info": "แสดงรายการ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ (หน้าที่ _PAGE_ จาก _PAGES_)",
                    "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "หน้าต่อไป",
                        "previous": "หน้าก่อนหน้า"
                    },
                    "loadingRecords": "โหลด...",
                    "processing": "โหลด...",
                },
            });
        });
    </script>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>