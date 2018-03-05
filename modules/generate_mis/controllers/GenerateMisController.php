<?php

namespace app\modules\generate_mis\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\applications\models\Institutes;
use app\modules\applications\models\InstituteHeaderTemplate;

class GenerateMisController extends \yii\web\Controller {

    public function actionIndex() {
        $model = new InstituteHeaderTemplate();
        $institutes = new Institutes();
//        return $this->render('index', ['institutes' => $institutes]);
        echo $this->render("index", ['model' => $model, 'institutes' => $institutes]);
    }

}
