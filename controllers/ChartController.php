<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

class ChartController extends Controller
{
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

    public function actionGetStockChart()
    {
           $request = Yii::$app->request->get();
        $product = $request["table"];
        $condition = $request["condition"];
        $category = $request["category"];
        $y = $request["y"];
        try {
            $fetch = Yii::$app->db->createCommand("SELECT $name as name,$y as y FROM `$product` $condition")->queryAll();
            if ($fetch) {
                $data["category_id"] = true;
                $data["data"] = [];
                foreach ($fetch as $ftch) {
                    $ftch["y"] = (float)$ftch["y"];
                    array_push($data["data"], $ftch);
                }
                return $this->asJson($data);
            }
        } catch (\Throwable $th) {
            $data = ["category_id" => false, "data" => $th];
            return $this->asJson($data);
        }
    }
}