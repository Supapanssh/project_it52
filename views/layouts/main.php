<?php

use app\assets\AppAsset;
use app\models\SiteInfo;
use yii\helpers\Html;

AppAsset::register($this);
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
</head>

<body class="sidebar-mini sidebar-collapse">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <?= $this->render('navbar') ?>

        <?= $this->render('sidebar') ?>

        <?= $this->render('content', ['content' => $content]) ?>

        <?= $this->render('footer') ?>
    </div>
    <?php $this->endBody() ?>

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
    <?php if (isset($this->blocks['scripts'])) : ?>
        <?= $this->blocks['scripts'] ?>
    <?php endif; ?>
</body>

</html>
<?php $this->endPage() ?>