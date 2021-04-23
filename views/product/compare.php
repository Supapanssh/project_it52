<?php

use app\models\Product;

$products = Product::find()->orderBy("sup_id,category_id,Product_name")->join("join", "supplier", "supplier.sup_id = product.sup_id")->all();
?>

<div class="table-responsive">

    <div class="card mt-3">
        <div class="card-header bg-primary">
            <h1 class="card-title">รายการเปรียบเทียบ</h1>
        </div>

        <h3 v-if="compareList.length <= 0" class="text-center p-3">เพิ่มสินค้าเพื่อเปรียบเทียบ</h3>
        <table v-else class="table data-table table-borderless table-inverse table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ชื่อสินค้า</th>
                    <th>หมวดหมู่สินค้า</th>
                    <th>ราคาทุน</th>
                    <th>ซัพพลายเออร์</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,index) in compareList">
                    <th>{{ item.Product_name }}</th>
                    <th>{{ item.category.category_name }}</th>
                    <th>{{ item.Product_cost }}</th>
                    <th>{{ item.sup.sup_company }}</th>
                    <th><a class="btn btn-danger" v-on:click="removeItem(index)">ลบออก</a></th>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="card-header bg-primary">
            <h1 class="card-title">
                รายการสินค้า</h1>
        </div>
        <div class="card-body p-2">
            <table class="table table-striped table-inverse data-table table-hover">
                <thead class="thead-inverse">
                    <tr>
                        <th>ชื่อสินค้า</th>
                        <th>หมวดหมู่สินค้า</th>
                        <th>ราคาทุน</th>
                        <th>ซัพพลายเออร์</th>
                        <th>เปรียบเทียบราคา</th>

                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product,index) in products">
                        <td>{{product.Product_name }}</td>
                        <td>{{product.category.category_name }}</td>
                        <td>{{product.Product_cost }}</td>
                        <td>{{product.sup.sup_company }}</td>
                        <td>
                            <a class="btn btn-success" v-on:click="addToList(product)">
                                <i class="fa fa-plus-square" aria-hidden="true"></i> เปรียบเทียบ
                            </a>


                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $this->beginBlock("scripts"); ?>
<script>
var app = new Vue({
    el: '#app',
    data: {
        compareList: [],
        products: [
            <?php foreach ($products as $product) : ?>
            <?= json_encode($product->getAttributes() + ["sup" => $product->sup->getAttributes()] + ["category" => $product->category->getAttributes()]) ?>,
            <?php endforeach; ?>
        ],
    },
    methods: {
        addToList: function(object) {
            this.compareList.push(object);
        },
        removeItem: function(index) {
            this.compareList.splice(index, 1);
        }
    }
})
</script>
<?php $this->endBlock(); ?>