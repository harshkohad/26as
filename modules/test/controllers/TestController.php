<?php

namespace app\modules\test\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
