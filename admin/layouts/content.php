<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <?php
                        if (!is_null($this->title)) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->
<<<<<<< HEAD
=======
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol id="w0" class="float-sm-right breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin-stock/web/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $this->title ?></li>
                        </ol>
                    </nav>
                </div>
>>>>>>> 3c8b23862db54ab49d0660683353f8ff554edc96
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <?= $content ?>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>