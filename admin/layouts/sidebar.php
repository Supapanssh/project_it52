<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text">Bumrungchu N/F</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= Yii::getAlias('@web'); ?>/images/admin.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : null ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <?php
            switch (Yii::$app->user->identity->roles) {
                case 0:
                    echo \hail812\adminlte3\widgets\Menu::widget([
                        'items' => [
                            [
                                'label' => 'Starter Pages',
                                'icon' => 'tachometer-alt',
                                'badge' => '<span class="right badge badge-info">2</span>',
                                'items' => [
                                    ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                                    ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                                ]
                            ],
                            ['label' => 'หนัาหลัก', 'icon' => 'home', 'url' => ['/site/index']],
                            ['label' => 'ขายสินค้า', 'icon' => 'shopping-cart', 'url' => ['/sellproduct']],
                            ['label' => 'ข้อมูลการซื้อขาย', 'icon' => 'users', 'url' => ['/bill']],
                        ],
                    ]);
                    break;
                case 10:
                    echo \hail812\adminlte3\widgets\Menu::widget([
                        'items' => [
                            ['label' => 'หนัาหลัก', 'icon' => 'home', 'url' => ['/site/index'],
                            'badge' => '<span class="right badge badge-info">2</span>',
                            'items' => [
                                ['label' => 'ข้อมูลยอดขายสินค้า', 'url' => ['site/line'], 'icon' => 'chart-line'],
                                ['label' => 'ข้อมูลพยากรณ์กำไร', 'url' => ['site/index'], 'icon' => 'chart-bar'],
                            ]            
                        
                        ],
                            ['label' => 'ขายสินค้า', 'icon' => 'shopping-cart', 'url' => ['/sellproduct']],
                            ['label' => 'รายการสินค้า', 'icon' => 'warehouse', 'url' => ['/product']],
                            ['label' => 'หมวดหมู่สินค้า', 'icon' => 'archive', 'url' => ['/category']],
                            ['label' => 'จัดการคลังสินค้า', 'icon' => 'tasks', 'url' => ['/manage']],
                            ['label' => 'บริษัทคู่ค้า', 'icon' => 'parachute-box', 'url' => ['/supplier']],
                            ['label' => 'พนักงาน', 'icon' => 'users', 'url' => ['/employee']],
                            ['label' => 'ผู้ใช้งาน', 'icon' => 'users-cog', 'url' => ['/user']],
                        ],
                    ]);
                    break;
                case 30:
                    echo \hail812\adminlte3\widgets\Menu::widget([
                        'items' => [
                            ['label' => 'หนัาหลัก', 'icon' => 'home', 'url' => ['/site/index'],
                            'badge' => '<span class="right badge badge-info">2</span>',
                            'items' => [
                                ['label' => 'ข้อมูลยอดขายสินค้า', 'url' => ['site/index'], 'icon' => 'chart-line'],
                                ['label' => 'ข้อมูลวิเคราะห์กำไร', 'url' => ['site/index'], 'icon' => 'chart-bar'],
                            ]            
                        
                        ],
                            ['label' => 'ขายสินค้า', 'icon' => 'shopping-cart', 'url' => ['/sellproduct']],
                            ['label' => 'รายการสินค้า', 'icon' => 'warehouse', 'url' => ['/product']],
                            ['label' => 'หมวดหมู่สินค้า', 'icon' => 'archive', 'url' => ['/category']],
                            ['label' => 'ข้อมูลการซื้อขาย', 'icon' => 'users', 'url' => ['/bill']],
                            ['label' => 'จัดการคลังสินค้า', 'icon' => 'tasks', 'url' => ['/manage']],
                            ['label' => 'บริษัทคู่ค้า', 'icon' => 'parachute-box', 'url' => ['/supplier']],
                            ['label' => 'พนักงาน', 'icon' => 'users', 'url' => ['/employee']],
                            ['label' => 'ผู้ใช้งาน', 'icon' => 'users-cog', 'url' => ['/user']],


                            ['label' => 'Yii2 PROVIDED', 'header' => true],
                            ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                            ['label' => 'Signup', 'url' => ['site/signup'], 'icon' => 'plus', 'visible' => Yii::$app->user->isGuest],
                            ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                            ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],

                        ],
                    ]);
                    break;
            }
            ?>
        </nav>
    </div>
</aside>