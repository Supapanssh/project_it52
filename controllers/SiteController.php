<?php

namespace app\controllers;

use app\components\myRule;
use app\models\Amphures;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SumaryBill;
use app\models\User;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'test-rule', 'index'],
                'ruleConfig' => [
                    'class' => myRule::className(), // เรียกใช้งาน accessRule (component) ที่เราสร้างขึ้นใหม่
                ],
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => [USER::ROLE_CHASIER, USER::ROLE_MANAGER, USER::ROLE_ADMIN],
                    ],
                    [
                        'actions' => ['test-rule'],
                        'allow' => true,
                        'roles' => [USER::ROLE_ADMIN],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $profit = SumaryBill::find();
        $request = Yii::$app->request;
        $chartObject = SumaryBill::find();
        $profit = $profit->select("sum(cost) as cost,sum(profit) as profit,sum(vat) as vat,BillDate,sum(price) as price");
        if (!empty($request->get("start_date"))) {
            $chartObject = $chartObject->andFilterWhere([">=", "BillDate", $request->get("start_date")]);
            $profit = $profit->andFilterWhere([">=", "BillDate", $request->get("start_date")]);
        }
        if (!empty($request->get("final_date"))) {
            $chartObject = $chartObject->andFilterWhere(["<=", "BillDate", $request->get("final_date")]);
            $profit = $profit->andFilterWhere(["<=", "BillDate", $request->get("final_date")]);
        }
        if (!empty($request->get("start_month"))) {
            $chartObject = $chartObject->andFilterWhere([">=", "BillDate", $request->get("start_month") . "-01"]); //2021-02-01
            $profit = $profit->andFilterWhere([">=", "BillDate", $request->get("start_month") . "-01"]); //2021-02-01

        }
        if (!empty($request->get("final_month"))) {
            $chartObject = $chartObject->andFilterWhere(["<=", "BillDate", $request->get("final_month") . "-31"]); //2021-02-31
            $profit = $profit->andFilterWhere(["<=", "BillDate", $request->get("final_month") . "-31"]); //2021-02-31

        }
        if (!empty($request->get("start_year"))) {
            $chartObject = $chartObject->andFilterWhere([">=", "BillDate", $request->get("start_year") . "-01-01"]);
            $profit = $profit->andFilterWhere([">=", "BillDate", $request->get("start_year") . "-01-01"]);
        }
        if (!empty($request->get("final_year"))) {
            $chartObject = $chartObject->andFilterWhere(["<=", "BillDate", $request->get("final_year") . "-12-31"]);
            $profit = $profit->andFilterWhere(["<=", "BillDate", $request->get("final_year") . "-12-31"]);
        }
        // return $profit->createCommand()->getRawSql();
        return $this->render('index', ["profit" => $profit,"chartObject" => $chartObject]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = '../../views/layouts/main-login';
        if (!Yii::$app->user->isGuest) {
            //เมื่อล็อคอินสำเร็จ
            switch (Yii::$app->user->identity->roles) {
                    //เช็คสถานะ
                case User::ROLE_ADMIN: //ถ้าเป็น แอดมิน
                    return $this->redirect(['/site']);
                    break;
                case User::ROLE_CHASIER: //ถ้าเป็นแคชเชีย
                    return $this->redirect(['/sellproduct']);
                    break;
                case User::ROLE_MANAGER: //ถ้าเป็น ผจก.
                    return $this->redirect(['/bill']);
                    break;
            }
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            switch (Yii::$app->user->identity->roles) {
                    //เช็คสถานะ
                case User::ROLE_ADMIN: //ถ้าเป็น แอดมิน
                    return $this->redirect(['/site']);
                    break;
                case User::ROLE_CHASIER: //ถ้าเป็นแคชเชีย
                    return $this->redirect(['/sellproduct']);
                    break;
                case User::ROLE_MANAGER: //ถ้าเป็น ผจก.
                    return $this->redirect(['/bill']);
                    break;
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionSignout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // public function actionSignup()
    // {
    //     $this->layout = '../../views/layouts/main-login';
    //     $model = new SignupForm();
    //     if ($model->load(Yii::$app->request->post())) {
    //         $user = $model->signup();
    //         if (Yii::$app->getUser()->login($user)) {
    //             return $this->goHome();
    //         }
    //     }
    //     return $this->render('signup', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = '../../views/layouts/main-login';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        // return $token;
        $this->layout = '../../views/layouts/main-login';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->user = User::find()->where(['password_reset_token' => $token])->one();
            $model->resetPassword();
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionGetAmphures($province)
    {
        // $amphures = Amphures::find()->leftJoin('provinces', 'provinces.id = amphures.province_id')
        //     ->where(['like', 'provinces.name_th', $province])->all();
        $amphures = Amphures::findBySql("SELECT `amphures`.* FROM `amphures` LEFT JOIN `provinces` ON provinces.id = amphures.province_id WHERE `provinces`.`id` = '$province'")->all();
        return $this->asJson($amphures);
    }

    public function actionGetDistricts($amphures)
    {
        // $amphures = Amphures::find()->leftJoin('provinces', 'provinces.id = amphures.province_id')
        //     ->where(['like', 'provinces.name_th', $province])->all();
        // $amphures = Amphures::findBySql("SELECT `amphures`.* FROM `amphures` LEFT JOIN `provinces` ON provinces.id = amphures.province_id WHERE `provinces`.`name_th` LIKE '%$province%'")->all();
        $districts = Yii::$app->db->createCommand("select * from districts where amphure_id ='$amphures'")->queryAll();
        return $this->asJson($districts);
    }

    public function actionGetZip($district)
    {
        // $amphures = Amphures::find()->leftJoin('provinces', 'provinces.id = amphures.province_id')
        //     ->where(['like', 'provinces.name_th', $province])->all();
        // $amphures = Amphures::findBySql("SELECT `amphures`.* FROM `amphures` LEFT JOIN `provinces` ON provinces.id = amphures.province_id WHERE `provinces`.`name_th` LIKE '%$province%'")->all();
        $zip = Yii::$app->db->createCommand("select * from districts where id ='$district'")->queryOne();
        return $this->asJson($zip);
    }
}
