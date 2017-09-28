<?php

namespace app\controllers;

use app\modules\icm\models\IcmDashboard;
use app\modules\networkDiscovery\models\DiscoveryDashboard;
use app\modules\networkDiscovery\models\InventoryDashboard;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\components\BaseController;

class SiteController extends BaseController {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => null,
            ],
        ];
    }

    public function actionIndex() {
        $this->layout = '//landingpage';
//        $inventoryDashboardModel = new InventoryDashboard();
//        $icmModel = new IcmDashboard();
//        $discoveryDashboardModel = new DiscoveryDashboard();
//        return $this->render('index', [
//                    'icmModel' => $icmModel,
//                    'inventoryDashboardModel' => $inventoryDashboardModel,
//                    'discoveryDashboardModel' => $discoveryDashboardModel
//        ]);
        
        return $this->render('homepage');
        
    }

//    public function actionLogin() {
//        if (!\Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        }
//        return $this->render('login', [
//                    'model' => $model,
//        ]);
//    }
//    public function actionLogout() {
//        Yii::$app->user->logout();
//
//        return $this->goHome();
//    }
//
//    public function actionContact() {
//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        }
//        return $this->render('contact', [
//                    'model' => $model,
//        ]);
//    }
//
//    public function actionAbout() {
//        return $this->render('about');
//    }

    public function actionTermsAndConditions() {
        return $this->render('termsandconditions');
    }

    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            if ($action->id == 'error')
                $this->layout = 'adminlte-fullpage';
            return true;
        } else {
            return false;
        }
    }

}
