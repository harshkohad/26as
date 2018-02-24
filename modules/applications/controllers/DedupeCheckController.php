<?php

namespace app\modules\applications\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\applications\models\ApplicantProfile;
use app\modules\applications\models\ApplicantProfileSearch;

class DedupeCheckController extends \yii\web\Controller {

    public function actionIndex() {
        
        $search_result = ['show_results' => FALSE];
        if (!empty($_POST)) {
            
            $model = new ApplicantProfile();
            $results = $model->applicationsSearch($_POST);
            
//            $queryParams['ApplicantProfileSearch']['first_name'] = $_POST['inputFirstName'];
//            $queryParams['ApplicantProfileSearch']['middle_name'] = $_POST['inputMiddleName'];
//            $queryParams['ApplicantProfileSearch']['last_name'] = $_POST['inputLastName'];
//            $queryParams['ApplicantProfileSearch']['mobile_no'] = $_POST['inputMobileNumber'];
//            $queryParams['ApplicantProfileSearch']['pan_card_no'] = $_POST['inputPanCard'];
//            $queryParams['ApplicantProfileSearch']['aadhaar_card_no'] = $_POST['inputAadhaarCard'];
//            $queryParams['ApplicantProfileSearch']['is_dedupe'] = TRUE;
//            
//            $searchModel = new ApplicantProfileSearch();
//            $dataProvider = $searchModel->search($queryParams);
//
//            $search_result = [
//                'searchModel' => $searchModel,
//                'dataProvider' => $dataProvider,
//                'show_results' => TRUE
//            ];
            
            $search_result = ['dataProvider' => $results, 'show_results' => TRUE];
        }
        return $this->render('index', $search_result);
    }

}
