<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\components\myRule;
use app\models\User;
use app\models\Amphures;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;

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
                    'class' => myRule::className() // เรียกใช้งาน accessRule (component) ที่เราสร้างขึ้นใหม่
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
                        'roles' => [USER::ROLE_ADMIN]
                    ]
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = '../../admin/layouts/main-login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
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
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionTestRule()
    {
        return 'grant acess rule!' . Yii::$app->user->identity->roles;
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
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
