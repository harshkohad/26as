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
        $data = [];
        $columns = [];
        if (!empty($_POST) & !empty($_POST['institute_id'])) {
            $model = new InstituteHeaderTemplate();
            $institute_id = $_POST['institute_id'];
            $results = $model->downloadCsvFile($institute_id, $_POST['start_date'], $_POST['end_date']);
            if (!empty($results)) {
                $data = $results['data'];
                $columns = $results['columns'];
            }
        }
        echo $this->render("index", ['institutes' => $institutes, 'data' => $data, 'columns' => $columns]);
    }

    public function actionDownload() {

        if (!empty($_REQUEST) & !empty($_REQUEST['data'])) {
            $data = unserialize($_REQUEST['data']);
            $model = new InstituteHeaderTemplate();
            $institute_id = $data['institute_id'];
            $results = $model->downloadCsvFile($institute_id, $data['start_date'], $data['end_date']);
            
            if (!empty($results)) {
                $data = $results['data'];
                $columns = $results['columns'];
                $model->downloadFile($columns, $data);
            }
        }
        $this->redirect(['index']);
    }

}
