<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Cart;
use app\models\Bill;
use app\models\BillDetail;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class SellproductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        $products = Product::find()->all();
        return $this->render('index', ['products' => $products]);
    }

    public function actionAddToCart($prod_id, $quantity)
    {
        $uid = Yii::$app->user->identity->userNo;
        if (Cart::find()->where("userNo=$uid AND PNo=$prod_id")->one()) //ค้นหาสินค้าอันแรกและผู้ใช้งาน ณ ตอนนี้
        {
            $cart = Cart::find()->where("userNo=$uid AND PNo=$prod_id")->one();
            $cart->quantity = $cart->quantity + $quantity; //เพิ่มจำนวน
            $cart->save();
        } else {
            $cart = new Cart();
            $cart->PNo = $prod_id;
            $cart->quantity = $quantity;
            $cart->userNo = Yii::$app->user->identity->userNo;
            $cart->save(); //insert เข้าฐานข้อมูล
        }

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl); //ย้อนกลับ
    }

    public function actionRemoveCart($prod_id)
    {
        $uid = Yii::$app->user->identity->userNo;
        if (Cart::find()->where("userNo=$uid AND PNo=$prod_id")->one()) //ค้นหาสินค้าอันแรกและผู้ใช้งาน ณ ตอนนี้
        {
            $cart = Cart::find()->where("userNo=$uid AND PNo=$prod_id")->one();
            $cart->delete();
            // ลบสินค้าออกจากตะกร้า
        }
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl); //ย้อนกลับ
    }

    public function actionMakeOrder()
    {
        //ย้ายสินค้าในตะกร้ามาเปิดรายการสั่งซื้อ
        // เอาสินค้าในตะกร้า Yii::$app->user->identity->carts
        // return $this->asJson(Yii::$app->user->identity->carts);

        $bill = new Bill();
        $bill->BillDate = date('Y-m-d H:i:s');
        $bill->PeoNo = Yii::$app->user->identity->id;
        $sum = 0;
        foreach (Yii::$app->user->identity->carts as $cart) {
            // echo $cart->pNo->Product_price * $cart->quantity;
            $sum += $cart->pNo->Product_price * $cart->quantity;
        } //คำนวณบิลรายการสินค้า 
        $bill->BillTotal = ($sum + ($sum * 0.07));
        $bill->Billvat = ($sum * 0.07);
        $bill->BillCash = $bill->BillTotal;   //วนลูปไป
        if ($bill->save()) {
            foreach (Yii::$app->user->identity->carts as $cart) {
                $bill_detail = new BillDetail();
                //สร้างออปเจ็คให้รายละเอียดบิล
                $bill_detail->pno = $cart->pNo->PNo;
                $bill_detail->quantity = $cart->quantity;
                $bill_detail->amount = $cart->pNo->Product_price * $cart->quantity;
                $bill_detail->bill_id = $bill->BillNo; //กำหนดไอดีบิลเป็นบิลที่เพิ่งเปิดรายการตรง bill->save()
                //กำหนดค่ารายละเอียดบิล
                $bill_detail->save();
            }
            //บันทึกรายละเอียดบิล
            $product = Product::findOne($cart->pNo->PNo); //ค้นหาโปรดัก 
            $product->Product_quantity = $product->Product_quantity - $cart->quantity; //ตัดตามจำนวนในตะกร้า เอาโปรดักจำนวนมาลบตะกร้าสินค้า
            $product->save(); //บันทึก

            // return $this->asJson($bill->billDetails);
            Cart::deleteAll("userNo = " . Yii::$app->user->identity->id); //คำสั่ง delete สำหรับเคลียร์ตะกร้าสินค้าที่ cart ที่ยูเซอปัจจุบันล้อกอินอยู่
            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl); //ย้อนกลับ
        } else {
            return $this->asJson([$bill, $bill->getErrors()]);
        }
    }
}
