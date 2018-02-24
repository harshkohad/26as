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
        $searchModel = new TblMobileUsersSearch();
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
//        if (!empty($_POST)) {
        $model = new InstituteHeaderTemplate();
            echo $this->renderAjax("create_header",['model'=>$model]);
//        }
    }

    public function actionNextTemplateForm() {
        if (!empty($_POST)) {
            $data = $_POST['Institutes'];
            $institute = $data['id'];
            $searchModel = new InstituteHeaderTemplate();
            $query = InstituteHeaderTemplate::find();
            $query->andFilterWhere([
                'institute_id' => $institute
            ]);
            $details = $query->all();
            $institute_name = '';
            echo $this->render("template_details", ['institute_name' => $institute_name, 'details' => $details, 'searchModel' => $searchModel]);
        }
    }

}
