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
        return $this->render('homepage');
    }

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
