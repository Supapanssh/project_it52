<?php

use app\models\SiteInfo;
use yii\helpers\Url;

$CASHIER_MENU = [
    'items' => [
        ['label' => 'หนัาหลัก', 'icon' => 'home', 'url' => ['/site/index']],
        ['label' => 'ขายสินค้า', 'icon' => 'shopping-cart', 'url' => ['/sellproduct']],
        ['label' => 'ข้อมูลการซื้อขาย', 'icon' => 'users', 'url' => ['/bill']],
    ],
];

$MANAGER_MENU = [
    'items' => [
        [
            'label' => 'หนัาหลัก', 'icon' => 'home', 'url' => ['/site/index'],

        ],
        ['label' => 'ขายสินค้า', 'icon' => 'shopping-cart', 'url' => ['/sellproduct']],
        ['label' => 'รายการสินค้า', 'icon' => 'warehouse', 'url' => ['/product']],
        ['label' => 'หมวดหมู่สินค้า', 'icon' => 'archive', 'url' => ['/category']],
        ['label' => 'จัดการคลังสินค้า', 'icon' => 'tasks', 'url' => ['/manage']],
        // ['label' => 'บริษัทคู่ค้า', 'icon' => 'parachute-box', 'url' => ['/supplier']],
        //  ['label' => 'พนักงาน', 'icon' => 'users', 'url' => ['/employee']],
        //  ['label' => 'ผู้ใช้งาน', 'icon' => 'users-cog', 'url' => ['/user']],
    ]
];

$ADMIN_MENU = [
    'items' => [
        [
            'label' => 'หนัาหลัก', 'icon' => 'home', 'url' => ['/site'],
            'badge' => '<span class="right badge badge-info">1</span>',
            'items' => [
                ['label' => 'ข้อมูลกราฟ', 'url' => ['site/index'], 'icon' => 'chart-line'],
                //['label' => 'ข้อมูลการขายสินค้า', 'url' => ['site/index'], 'icon' => 'chart-bar'],
            ]
        ],
        ['label' => 'ขายสินค้า', 'icon' => 'shopping-cart', 'url' => ['/sellproduct']],
        ['label' => 'รายการสินค้า', 'icon' => 'warehouse', 'url' => ['/product']],
        ['label' => 'หมวดหมู่สินค้า', 'icon' => 'archive', 'url' => ['/category']],
        ['label' => 'ข้อมูลการซื้อขาย', 'icon' => 'users', 'url' => ['/bill']],
        ['label' => 'จัดการคลังสินค้า', 'icon' => 'tasks', 'url' => ['/manage']],
        //['label' => 'สั่งซื้อสินค้า', 'icon' => 'shopping-basket', 'url' => ['/']],
        ['label' => 'บริษัทคู่ค้า', 'icon' => 'parachute-box', 'url' => ['/supplier']],
        ['label' => 'พนักงาน', 'icon' => 'users', 'url' => ['/employee']],
        ['label' => 'ผู้ใช้งาน', 'icon' => 'users-cog', 'url' => ['/user']],
    ],
];

?>
<?php switch (SiteInfo::getUserRole()) {
    case 0:
        $menus = $CASHIER_MENU;
        break;
    case 10:
        $menus = $MANAGER_MENU;
        break;
    default:
        $menus = $ADMIN_MENU;
        break;
} ?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= \yii\helpers\Url::home() ?>" class="brand-link">
        <span class="brand-text">Bumrungchu N/F</span>

    </a>
    <?php if (!Yii::$app->user->isGuest) : ?>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= Yii::getAlias('@web'); ?>/images/admin.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= !Yii::$app->user->isGuest ? Yii::$app->user->identity->username : null ?></a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">
                        <?= Yii::$app->user->identity->roles == 0 ? 'เมนูแคชเชียร์' : '' ?>
                        <?= Yii::$app->user->identity->roles == 10 ? 'เมนูผู้จัดการ' : '' ?>
                        <?= Yii::$app->user->identity->roles == 30 ? 'เมนูแอดมิน' : '' ?>
                    </li>
                    <?php switch (SiteInfo::getUserRole()) {
                        case 0:
                            $menus = $CASHIER_MENU;
                            break;
                        case 10:
                            $menus = $MANAGER_MENU;
                            break;
                        default:
                            $menus = $ADMIN_MENU;
                            break;
                    } ?>

                    <?php foreach ($menus['items'] as $menu) : ?>
                        <?php if (!empty($menu['items'])) : ?>
                            <li class="nav-item has-treeview menu-is-opening menu-open">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        <?= $menu['label'] ?>
                                        <i class="right fa fa-angle-left right"></i>
                                    </p>
                                </a>
                                <?php foreach ($menu['items'] as $subMenu) : ?>
                                    <ul class="nav nav-treeview" style="display: none;">
                                        <li class="nav-item">
                                            <a href="<?= Url::to($subMenu['url']) ?? ['site/index'] ?>" class="nav-link <?= strpos(Yii::$app->request->url, Url::to($subMenu['url'])) !== false ? 'active' : '' ?>">
                                                &nbsp;&nbsp;&nbsp; <i class="fa fa-<?= $subMenu['icon'] ?? 'home' ?> nav-icon"></i>
                                                <p><?= $subMenu['label'] ?></p>
                                            </a>
                                        </li>
                                    </ul>
                                <?php endforeach; ?>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a href="<?= Url::to($menu['url'] ?? ["site/index"]) ?>" class="nav-link <?= strpos(Yii::$app->request->url, Url::to($menu['url'])) !== false ? 'active' : '' ?>">
                                    <i class="nav-icon fa fa-<?= $menu['icon'] ?? 'home' ?>"></i>
                                    <p>
                                        <?= $menu['label'] ?>
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    <?php endif; ?>

</aside>