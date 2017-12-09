<?php

namespace app\modules\applications\controllers;

use Yii;
use app\modules\applications\models\Applications;
use app\modules\applications\models\ApplicationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\applications\models\Itr;
use app\modules\applications\models\Noc;
use app\modules\applications\models\Kyc;
use app\modules\applications\models\Institutes;
use app\modules\applications\models\LoanTypes;
use app\modules\applications\models\Area;
use kartik\date\DatePicker;
use kartik\widgets\FileInput;
use app\modules\applications\models\ApplicantProfile;

/**
 * ManageApplicationsController implements the CRUD actions for Applications model.
 */
class ManageApplicationsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Applications models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ApplicationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Applications model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $itrTable = $this->getItrTableHtml($id);
        $nocTable = $this->getNocTableHtml($id);
        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'itrTable' => $itrTable,
                    'nocTable' => $nocTable,
        ]);
    }

    /**
     * Creates a new Applications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($profile_id = NULL) {
        $model = new Applications();
        $institutes = new Institutes();
        $loantypes = new LoanTypes();
        $area_model = new Area();

        if (!empty($profile_id)) {
            $applicant_profile = ApplicantProfile::find($profile_id)->one();
            $data = $applicant_profile->attributes;
            $model->setAttributes($data);
        }

        if (Yii::$app->request->post()) {

            $post_data = Yii::$app->request->post();
            if (!empty($profile_id)) {
                $model->profile_id = $profile_id;
            } else {
                #create profile
                $new_applicant_profile = new ApplicantProfile();
                $new_applicant_profile->first_name = $post_data['Applications']['first_name'];
                $new_applicant_profile->middle_name = $post_data['Applications']['middle_name'];
                $new_applicant_profile->last_name = $post_data['Applications']['last_name'];
                $new_applicant_profile->aadhaar_card_no = $post_data['Applications']['aadhaar_card_no'];
                $new_applicant_profile->pan_card_no = $post_data['Applications']['pan_card_no'];
                $new_applicant_profile->mobile_no = $post_data['Applications']['mobile_no'];
                $new_applicant_profile->save(FALSE);

                $model->profile_id = $new_applicant_profile->id;
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                #Save Application id
                $model->application_id = self::getApplicationId($model->id);
                $model->save();
                $step2 = isset($_REQUEST['step2']) ? $_REQUEST['step2'] : 0;
                return $this->redirect(['update', 'id' => $model->id, 'step2' => $step2]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'institutes' => $institutes,
                        'loantypes' => $loantypes,
                        'area_model' => $area_model,
            ]);
        }
    }

    /**
     * Updates an existing Applications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $institutes = new Institutes();
        $loantypes = new LoanTypes();
        $area_model = new Area();
        $itrTable = $this->getItrTable($id);
        $nocTable = $this->getNocTable($id);
        $kycTable = $this->actionGetKycTable($id);

        $step2 = isset($_REQUEST['step2']) ? $_REQUEST['step2'] : 0;

        if (Yii::$app->request->post()) {
            #ITR
            if (isset($_POST['itr']) && !empty($_POST['itr'])) {
                $this->processItr($_POST['itr'], $model->id);
            }
            #NOC
            if (isset($_POST['noc']) && !empty($_POST['noc'])) {
                $this->processNoc($_POST['noc'], $model->id);
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'step2' => $step2,
                        'institutes' => $institutes,
                        'loantypes' => $loantypes,
                        'area_model' => $area_model,
                        'itrTable' => $itrTable,
                        'nocTable' => $nocTable,
                        'kycTable' => $kycTable,
            ]);
        }
    }

    /**
     * Deletes an existing Applications model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Applications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Applications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Applications::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getItrTable($id) {

        $itrs = Itr::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();

        $return_html = '<table  class="table table-hover small-text" id="itr_table">
                        <tr class="tr-header">
                            <th>Total Income</th>
                            <th>Date of Filing</th>
                            <th>Pan no.</th>
                            <th>Acknowledgement No.</th>
                            <th>Assesement year (YYYY-YYYY)</th>
                            <th><a href="javascript:void(0);" style="font-size:18px;" id="addMoreItr" title="Add More ITR"><span class="glyphicon glyphicon-plus"></span></a></th>';
        $return_html .= '</tr>';
        if (!empty($itrs)) {
            foreach ($itrs as $itr_data) {
                $return_html .= '<tr>';
                $return_html .= '<td><input type="text" name="itr[total_income][]" value="' . $itr_data['total_income'] . '" class="form-control"></td>';
                $return_html .= '<td><input type="date" max="' . date('Y-m-d') . '" name="itr[date_of_filing][]" value="' . $itr_data['date_of_filing'] . '" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="itr[pan_card_no][]" value="' . $itr_data['pan_card_no'] . '" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="itr[acknowledgement_no][]" value="' . $itr_data['acknowledgement_no'] . '" class="form-control"></td>';
                $return_html .= '<td><input type="text" pattern="[0-9]{4}-[0-9]{4}" name="itr[assessment_year][]" value="' . $itr_data['assessment_year'] . '" class="form-control"></td>';
                $return_html .= '<td><a href="javascript:void(0);"  class="remove"><span class="glyphicon glyphicon-trash"></span></a></td>';
                $return_html .= '</tr>';
            }
        } else {
            $return_html .= '<tr>';
            $return_html .= '<td><input type="text" name="itr[total_income][]" class="form-control"></td>';
            $return_html .= '<td><input type="date" max="' . date('Y-m-d') . '" name="itr[date_of_filing][]" class="form-control"></td>';
            $return_html .= '<td><input type="text" name="itr[pan_card_no][]" class="form-control"></td>';
            $return_html .= '<td><input type="text" name="itr[acknowledgement_no][]" class="form-control"></td>';
            $return_html .= '<td><input type="text" name="itr[assessment_year][]" class="form-control"></td>';
            $return_html .= '<td><a href="javascript:void(0);"  class="remove"><span class="glyphicon glyphicon-trash"></span></a></td>';
            $return_html .= '</tr>';
        }

        $return_html .= '</table>';

        return $return_html;
    }

    public function getItrTableHtml($id) {
        $itrs = Itr::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();

        $return_html = '<table class="table table-hover small-text">
                        <tr class="tr-header">
                            <th>Total Income</th>
                            <th>Date of Filing</th>
                            <th>Pan no.</th>
                            <th>Acknowledgement No.</th>
                            <th>Assesement year (YYYY-YYYY)</th>';
        $return_html .= '</tr>';
        if (!empty($itrs)) {
            foreach ($itrs as $itr_data) {
                $return_html .= '<tr>';
                $return_html .= '<td>' . $itr_data['total_income'] . '></td>';
                $return_html .= '<td>' . $itr_data['date_of_filing'] . '</td>';
                $return_html .= '<td>' . $itr_data['pan_card_no'] . '</td>';
                $return_html .= '<td>' . $itr_data['acknowledgement_no'] . '</td>';
                $return_html .= '<td>' . $itr_data['assessment_year'] . '</td>';
                $return_html .= '</tr>';
            }
        } else {
            $return_html .= '<tr>';
            $return_html .= '<td colspan=5>No records Found!!!</td>';
            $return_html .= '</tr>';
        }

        $return_html .= '</table>';

        return $return_html;
    }

    public function getNocTable($id) {

        $nocs = Noc::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();

        $return_html = '<table  class="table table-hover small-text" id="noc_table">
                        <tr class="tr-header">
                            <th>Met Person</th>
                            <th>Designation</th>
                            <th>Remarks</th>
                            <th><a href="javascript:void(0);" style="font-size:18px;" id="addMoreNoc" title="Add More NOC"><span class="glyphicon glyphicon-plus"></span></a></th>';
        $return_html .= '</tr>';
        if (!empty($nocs)) {
            foreach ($nocs as $noc_data) {
                $return_html .= '<tr>';
                $return_html .= '<td><input type="text" name="noc[met_person][]" value="' . $noc_data['met_person'] . '" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="noc[designation][]" value="' . $noc_data['designation'] . '" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="noc[remarks][]" value="' . $noc_data['remarks'] . '" class="form-control"></td>';
                $return_html .= '<td><a href="javascript:void(0);"  class="remove"><span class="glyphicon glyphicon-trash"></span></a></td>';
                $return_html .= '</tr>';
            }
        } else {
            $return_html .= '<tr>';
            $return_html .= '<td><input type="text" name="noc[met_person][]" class="form-control"></td>';
            $return_html .= '<td><input type="text" name="noc[designation][]" class="form-control"></td>';
            $return_html .= '<td><input type="text" name="noc[remarks][]" class="form-control"></td>';
            $return_html .= '<td><a href="javascript:void(0);"  class="remove"><span class="glyphicon glyphicon-trash"></span></a></td>';
            $return_html .= '</tr>';
        }

        $return_html .= '</table>';

        return $return_html;
    }

    public function getNocTableHtml($id) {

        $nocs = Noc::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();

        $return_html = '<table  class="table table-hover small-text" id="noc_table">
                        <tr class="tr-header">
                            <th>Met Person</th>
                            <th>Designation</th>
                            <th>Remarks</th>';
        $return_html .= '</tr>';
        if (!empty($nocs)) {
            foreach ($nocs as $noc_data) {
                $return_html .= '<tr>';
                $return_html .= '<td>' . $noc_data['met_person'] . '</td>';
                $return_html .= '<td>' . $noc_data['designation'] . '</td>';
                $return_html .= '<td>' . $noc_data['remarks'] . '</td>';
                $return_html .= '</tr>';
            }
        } else {
            $return_html .= '<tr>';
            $return_html .= '<td colspan=3>No records Found!!!</td>';
            $return_html .= '</tr>';
        }

        $return_html .= '</table>';

        return $return_html;
    }

    public function actionGetKycTable($id, $isAjaxCall = NULL) {

        $nocs = Kyc::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();

        $return_html = '';

        $return_html .= '<table class="table table-striped table-bordered">
                        <thead>
                        <tr class="tr-header">
                            <th>Doc type</th>
                            <th>Remarks</th>
                            <th><button type="button" class="btn btn-primary" id="addMoreKyc"><i class="fa fa-plus"></i></button></th>';
        $return_html .= '</tr></thead>';
        if (!empty($nocs)) {
            foreach ($nocs as $noc_data) {
                $return_html .= '<tr>';
                $return_html .= '<td>' . $noc_data['doc_type'] . '</td>';
                $return_html .= '<td>' . $noc_data['remarks'] . '</td>';
//                $return_html .= '<td>'.$noc_data['file_name'].'</td>';                
                $return_html .= '<td align="center"><button type="button" class="btn btn-success viewKyc" value="' . $noc_data['id'] . '"><i class="fa fa-eye"></i></button> <button type="button" class="btn btn-danger deleteKyc" value="' . $noc_data['id'] . '"><i class="fa fa-trash-o"></i></button></td>';
                $return_html .= '</tr>';
            }
        } else {
            $return_html .= '<tr>';
            $return_html .= '<td colspan="3">No records Found!!!</td>';
            $return_html .= '</tr>';
        }

        $return_html .= '</table>';

        if(!empty($isAjaxCall)) {
            echo $return_html;
        } else {
            return $return_html;
        }
    }

    public function processItr($itr_data, $id) {
        Itr::deleteAll('application_id = :application_id', [':application_id' => $id]);
        $for_count = count($itr_data['total_income']);

        if ($for_count == 1) {
            if (empty($itr_data['total_income'][0]) && empty($itr_data['date_of_filing'][0]) && empty($itr_data['pan_card_no'][0]) && empty($itr_data['acknowledgement_no'][0]) && empty($itr_data['assessment_year'][0])) {
                return true;
            }
        }

        for ($i = 0; $i < $for_count; $i++) {
            $model = new Itr();

            $model->application_id = $id;
            $model->total_income = isset($itr_data['total_income'][$i]) ? $itr_data['total_income'][$i] : 0;
            $model->date_of_filing = isset($itr_data['date_of_filing'][$i]) ? $itr_data['date_of_filing'][$i] : '0000-00-00';
            $model->pan_card_no = isset($itr_data['pan_card_no'][$i]) ? $itr_data['pan_card_no'][$i] : '';
            $model->acknowledgement_no = isset($itr_data['acknowledgement_no'][$i]) ? $itr_data['acknowledgement_no'][$i] : '';
            $model->assessment_year = isset($itr_data['assessment_year'][$i]) ? $itr_data['assessment_year'][$i] : '0000-00-00';
            $model->save();
        }
    }

    public function processNoc($noc_data, $id) {
        Noc::deleteAll('application_id = :application_id', [':application_id' => $id]);
        $for_count = count($noc_data['met_person']);

        if ($for_count == 1) {
            if (empty($noc_data['met_person'][0]) && empty($noc_data['designation'][0]) && empty($noc_data['remarks'][0])) {
                return true;
            }
        }

        for ($i = 0; $i < $for_count; $i++) {
            $model = new Noc();

            $model->application_id = $id;
            $model->met_person = isset($noc_data['met_person'][$i]) ? $noc_data['met_person'][$i] : '';
            $model->designation = isset($noc_data['designation'][$i]) ? $noc_data['designation'][$i] : '';
            $model->remarks = isset($noc_data['remarks'][$i]) ? $noc_data['remarks'][$i] : '';
            $model->save();
        }
    }

    public function actionGetApplicantProfile() {
        $return_data = '';
        if (Yii::$app->request->post()) {
            $data = Yii::$app->request->post();

            $query_condition = array();

            $query = '';

            if (!empty($data['inputFirstName'])) {
                $query_condition["first_name"] = $data['inputFirstName'];
            }
            if (!empty($data['inputMiddleName'])) {
                $query_condition["middle_name"] = $data['inputMiddleName'];
            }
            if (!empty($data['inputLastName'])) {
                $query_condition["last_name"] = $data['inputLastName'];
            }
            if (!empty($data['inputMobileNumber'])) {
                $query_condition["mobile_no"] = $data['inputMobileNumber'];
            }
            if (!empty($data['inputPanCard'])) {
                $query_condition["pan_card_no"] = $data['inputPanCard'];
            }
            if (!empty($data['inputAadhaarCard'])) {
                $query_condition["aadhaar_card_no"] = $data['inputAadhaarCard'];
            }
            if (!empty($query_condition)) {
                $query = ApplicantProfile::find()->where($query_condition)->all();
            }

            if (!empty($query)) {
                $return_data .= '<table class="table table-hover table-bordered table-striped">
                    <thead align="left" style="display: table-header-group">
                        <tr>
                           <th>Sr No.</th>
                           <th>Name</th>
                           <th>Mobile No</th>
                           <th>Pan Card</th>
                           <th>Aadhaar</th>
                           <th>Action</th>
                        </tr>
                    </thead>
                  <tbody>';
                $sr = 1;
                foreach ($query as $app_profile) {
                    #Create table
                    $return_data .= '<tr class="item_row">';
                    $return_data .= "<td>" . $sr++ . "</td>";
                    $return_data .= "<td>" . $app_profile['first_name'] . ' ' . $app_profile['middle_name'] . ' ' . $app_profile['last_name'] . "</td>";
                    $return_data .= "<td>{$app_profile['mobile_no']}</td>";
                    $return_data .= "<td>{$app_profile['pan_card_no']}</td>";
                    $return_data .= "<td>{$app_profile['aadhaar_card_no']}</td>";
                    $return_data .= '<td><button style="margin-bottom: 10px !important;" type="button" class="btn btn-primary btn_select_record" value="' . $app_profile['id'] . '">
                                     <i class="fa fa-external-link"></i> Select</button></td>';
                    $return_data .= '</tr>';
                }
                $return_data .= '</tbody></table>';
            } else {
                $return_data = 'No records Found!!!';
            }
        } else {
            $return_data = 'No records Found!!!';
        }
        return $return_data;
    }

    public function getApplicationId($id) {
        $curr_data = date('dmy');
        $prefix = 'ACS';
        $number = str_pad($id, 5, '0', STR_PAD_LEFT);

        return $prefix . $curr_data . $number;
    }

    public function actionUploadKyc() {
        if (!empty($_POST)) {
            $data = $_POST;

            $application_number = $data['application_number'];
            $doc_type = $data['doc_type'];
            $kyc_remarks = $data['kyc_remarks'];
            $application_id = $data['application_id'];
       
            $dirname = 'uploads/kyc/'.$application_number;
            if (!file_exists($dirname)) {
                mkdir($dirname);
                mkdir($dirname.'/thumbs');
            }

            if (isset($_FILES['kyc_file'])) {
                $errors = array();
                $file_name = $_FILES['kyc_file']['name'];
                $newfile_name = date('dmYHis').$_FILES['kyc_file']['name'];
                $file_size = $_FILES['kyc_file']['size'];
                $file_tmp = $_FILES['kyc_file']['tmp_name'];
                $file_type = $_FILES['kyc_file']['type'];
                
                $file_name_exploded = explode('.', $file_name);
                $file_ext = strtolower(end($file_name_exploded));
                
                $expensions = array("jpeg", "jpg", "png");

                if (in_array($file_ext, $expensions) === false) {
                    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                }

                if ($file_size > 2097152) {
                    $errors[] = 'File size must be excately 2 MB';
                }

                if (empty($errors) == true) {
                    if(move_uploaded_file($file_tmp, $dirname.'/'. $newfile_name)) { 
                        #Create Thumbnail
                        $upload_img = Applications::thumbnailCreator($newfile_name,$dirname,'thumbs','200','160', $file_tmp, $file_ext);
                        
                        #Add data to kyc
                        $kyc_model = new Kyc();
                        
                        $kyc_model->application_id = $application_id;
                        $kyc_model->doc_type = $doc_type;
                        $kyc_model->remarks = $kyc_remarks;
                        $kyc_model->file_name = $newfile_name;
                        
                        $kyc_model->save(FALSE);
                        
                        echo "Upload Successful";
                    } else {
                        echo "Something went wrong!!!";
                    }
                } else {
                    print_r($errors);
                }
            }
        } else {
            echo 'Something went wrong!!!';
        }
    }

}
