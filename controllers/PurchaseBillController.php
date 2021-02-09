<?php

namespace app\controllers;

use app\models\Purchase;
use Yii;
use app\models\PurchaseBill;
use app\models\PurchaseBillSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PurchaseBillController implements the CRUD actions for PurchaseBill model.
 */
class PurchaseBillController extends Controller
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

    /**
     * Lists all PurchaseBill models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PurchaseBillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PurchaseBill model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PurchaseBill model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PurchaseBill();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            for ($i = 0; $i < sizeOf($_POST["prod_id"]); $i++) {
                $list = new Purchase();
                $list->PNo = $_POST["prod_id"][$i];
                $list->quantity = $_POST["prod_qty"][$i];
                $list->bill_id = $model->id;
                if (!$list->save()) {
                    return $this->asJson($list->getErrors());
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PurchaseBill model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Purchase::deleteAll(["bill_id" => $model->id]);
            for ($i = 0; $i < sizeOf($_POST["prod_id"]); $i++) {
                $list = new Purchase();
                $list->PNo = $_POST["prod_id"][$i];
                $list->quantity = $_POST["prod_qty"][$i];
                $list->bill_id = $model->id;
                if (!$list->save()) {
                    return $this->asJson($list->getErrors());
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PurchaseBill model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PurchaseBill model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurchaseBill the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurchaseBill::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
