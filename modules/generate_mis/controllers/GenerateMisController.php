<?php

namespace app\modules\generate_mis\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\applications\models\Institutes;

class GenerateMisController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $institutes = Institutes::find()->all();
        return $this->render('index', ['institutes' => $institutes]);
        
    }

}
