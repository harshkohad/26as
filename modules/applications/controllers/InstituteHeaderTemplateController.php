<?php

namespace app\modules\applications\controllers;

use yii;
use app\modules\manage_mobile_app\models\TblMobileUsersSearch;
use app\modules\applications\models\Institutes;
use app\modules\applications\models\InstituteHeaderTemplate;

class InstituteHeaderTemplateController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCreateTemplate() {
        $searchModel = new InstituteHeaderTemplate();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('create_template', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetNextTemplate() {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        $institutes = new Institutes();
        echo $this->renderPartial("institues", ['institutes' => $institutes,]);
    }

    public function actionCreateHeader() {
        if (!empty($_POST)) {
            $id = $_POST['Institutes']['id'];
            $model = new InstituteHeaderTemplate();
            $model->institute_id = $id;
            echo $this->renderAjax("create_header", ['model' => $model, 'institute_id' => $id]);
        } else {
            echo "<font color='red'>Institute id not found</font>";
            die;
        }
    }

    public function actionNextTemplateForm() {
        if (!empty($_REQUEST)) {
            if (!isset($_REQUEST['id'])) {
                $data = $_POST['Institutes'];
                $institute_id = $data['id'];
            } else {
                $institute_id = $_REQUEST['id'];
            }


            $model = new Institutes();
            $model->id = $institute_id;
            $institute_name = '';
            $data = $model->findOne(['id' => $institute_id]);
            if (!empty($data)) {
                $institute_name = $data->name;
            }
            $searchModel = new InstituteHeaderTemplate();
            $query = InstituteHeaderTemplate::find();
            $query->andFilterWhere([
                'institute_id' => $institute_id
            ]);
            $details = $query->one();
            $data = array();
            if (!empty($details)) {
                $fields = $details['fields'];
                $fields = json_decode($fields);
                foreach ($fields as $key => $field) {
                    $data[] = array('header' => $key, 'field' => $field);
                }
            }
            echo $this->render("template_details", ['institute_name' => $institute_name, 'details' => $data, 'searchModel' => $searchModel, 'institute_id' => $institute_id, 'model' => $model]);
        }
    }

    public function actionSaveHeader() {
        if (!empty($_POST) AND isset($_POST['InstituteHeaderTemplate'])) {
            $data = $_POST['InstituteHeaderTemplate'];

            $institute_id = $data['institute_id'];


            $model = new InstituteHeaderTemplate();
            $teplateData = $model->findOne(['institute_id' => $institute_id]);
            $fields = array();
            if (!empty($teplateData)) {
                $fields = (array) json_decode($teplateData['fields']);
            } else {
                $teplateData = new InstituteHeaderTemplate();
            }
            $teplateData->institute_id = $institute_id;
            $teplateData->header = $data['header'];
            $teplateData->created_at = date("Y-m-d H:i:s");
            $fields[$teplateData->header] = $data['fields'];
            $teplateData->fields = json_encode($fields);
            $teplateData->save();
            echo "Done";
            exit;
        } else {
            echo "not saved";
        }
    }

    public function actionSaveFinalHeader() {
        if (!empty($_POST)) {
            $model = new InstituteHeaderTemplate();
            $institute_header = $_POST['institute_header'];
            $institute_id = $_POST['Institutes']['id'];
            $teplateData = $model->findOne(['institute_id' => $institute_id]);
            $institute_value = $_POST['institute_value'];
            $fields = array();
            if (!empty($institute_header)) {
                foreach ($institute_header as $key => $value) {
                    $fields[$value] = $institute_value[$key];
                }
            }
            $teplateData->created_at = date("Y-m-d H:i:s");
            $teplateData->final_fields = json_encode($fields);
            $teplateData->fields = json_encode($fields);
            $teplateData->save();
            echo "Done";
            exit;
        }
        echo "Done";
        exit;
    }

}
