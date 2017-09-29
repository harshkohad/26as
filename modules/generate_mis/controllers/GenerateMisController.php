<?php

namespace app\modules\generate_mis\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class GenerateMisController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
