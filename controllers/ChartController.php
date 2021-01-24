<?php

namespace app\controllers;

use app\components\MyRule;
use app\models\SiteInfo;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;
use yii\filters\AccessControl;

class ChartController extends Controller
{
    public $mainUrl = null;
    public $primaryKey = null;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['get-view', 'get-gpax'],
                'ruleConfig' => [
                    'class' => MyRule::class,
                ],
                'rules' => [
                    [
                        'actions' => ['get-view', "get-gpax"],
                        'allow' => true,
                        'roles' => ["@"]
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [],
            ],
        ];
    }

    public function actionGetView()
    {
        $request = Yii::$app->request;
        $tableName = $request->get('tableName');
        $label = $request->get('label');
        $chartType = $request->get('chartType');
        $condition = $request->get('condition');
        $chartName = $request->get('chartName');
        $groupBy = $request->get('groupBy');
        $unit = $request->get('unit');
        $y = $request->get('y');
        $hide = explode(",", $request->get("hide"));

        $chart['cursor'] = 'pointer';
        $chart['name'] = $chartName;
        $chart['type'] = $chartType;
        $chart['toolTipContent'] = "<b>{label}</b>: {y} $unit";
        $dbColumns = Yii::$app->db->createCommand("SHOW FULL COLUMNS FROM `$tableName`")->queryAll();
        $fields = [];
        $comments = [];

        foreach ($dbColumns as $dbCol) {
            if (!in_array($dbCol['Field'], $hide)) {
                array_push($fields, $dbCol['Field']);
                if (!empty(SiteInfo::COMMENT[$dbCol['Field']])) {
                    $dbCol['Comment'] = SiteInfo::COMMENT[$dbCol['Field']];
                }
                array_push($comments, !empty($dbCol['Comment']) ? $dbCol['Comment'] : $dbCol['Field']);
            }
        }

        $rawData["fields"] = $fields;
        $rawData['comments'] = $comments;
        $rawSql = "SELECT *,$label as label,$y as y FROM `$tableName`";
        $rawDataSql = "SELECT * FROM `$tableName`";
        if (!empty($condition)) {
            $rawSql .= " where $condition";
            $rawDataSql .= " where $condition";
        }
        $rawData['sql'] = $rawDataSql;
        $rawData['data'] = Yii::$app->db->createCommand($rawDataSql)->queryAll();
        if (!empty($groupBy)) {
            $rawSql .= " group by $groupBy";
        }
        $fetch = Yii::$app->db->createCommand($rawSql)->queryAll();
        $data = [];
        if ($fetch) {
            foreach ($fetch as $ftch) {
                $ftch["y"] = (float)$ftch["y"];
                array_push($data, $ftch);
            }
        }
        $chart['dataPoints'] = $data;
        return $this->asJson([[$chart], $rawData]);
    }
}
