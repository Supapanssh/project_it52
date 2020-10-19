<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Cart;
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
            // return $this->asJson($cart);
        } else {
            $cart = new Cart();

            $cart->PNo = $prod_id;
            $cart->quantity = $quantity;
            $cart->userNo = Yii::$app->user->identity->userNo;
            $cart->save(); //insert เข้าฐานข้อมูล
        }

        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl); //ย้อนกลับ
        // return $this->asJson($cart);
    }
}
