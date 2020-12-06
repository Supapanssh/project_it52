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

    public function actionGetChart()
    {
        $request = Yii::$app->request->get();
        $table = $request["table"];
        $condition = $request["condition"];
        $name = $request["name"];
        $y = $request["y"];
        try {
            $fetch = Yii::$app->db->createCommand("SELECT $name as name,$y as y FROM `$table` $condition")->queryAll();
            if ($fetch) {
                $data["status"] = true;
                $data["data"] = [];
                foreach ($fetch as $ftch) {
                    $ftch["y"] = (float)$ftch["y"];
                    array_push($data["data"], $ftch);
                }
                return $this->asJson($data);
            }
        } catch (\Throwable $th) {
            $data = ["status" => false, "data" => $th];
            return $this->asJson($data);
        }
    }
}