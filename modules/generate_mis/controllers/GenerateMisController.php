<?php

namespace app\modules\generate_mis\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\applications\models\Institutes;
use app\modules\applications\models\InstituteHeaderTemplate;

class GenerateMisController extends \yii\web\Controller {

    public function actionIndex() {
        $institutes = new Institutes();
        if (!empty($_POST) & !empty($_POST['institute_id'])) {
            $model = new InstituteHeaderTemplate();
            $institute_id = $_POST['institute_id'];
            $model->downloadCsvFile($institute_id, $_POST['start_date'], $_POST['end_date']);
        }
        echo $this->render("index", ['institutes' => $institutes]);
    }

}
