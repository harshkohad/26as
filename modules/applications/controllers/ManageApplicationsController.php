<?php

namespace app\modules\applications\controllers;

use Yii;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use kartik\date\DatePicker;
use kartik\widgets\FileInput;
use app\modules\applications\models\Applications;
use app\modules\applications\models\ApplicationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\applications\models\Itr;
use app\modules\applications\models\Noc;
use app\modules\applications\models\Kyc;
use app\modules\applications\models\Institutes;
use app\modules\applications\models\LoanTypes;
use app\modules\applications\models\Area;
use app\modules\applications\models\ApplicantProfile;
use app\modules\applications\models\ApplicantPhotos;
use app\modules\applications\models\PincodeMaster;
use app\modules\applications\models\ApplicationsVerifiers;
use app\modules\manage_mobile_app\models\TblMobileUsers;
use app\modules\applications\models\ApplicationsUploads;
use app\modules\applications\models\ApplicationsUploadsSearch;
use app\modules\applications\models\ApplicationsVerifiersRevoked;
use yii\base\ErrorException;
use PHPExcel_Style_Fill;
use app\modules\applications\models\ApplicationsHistory;
use app\modules\applications\models\ApplicationParagraph;
use app\modules\applications\models\ApplicationsResi;
use app\modules\applications\models\ApplicationsBusi;
use app\modules\applications\models\ApplicationsOffice;
use app\modules\applications\models\ApplicationsNocBusi;
use app\modules\applications\models\ApplicationsResiOffice;
use app\modules\applications\models\ApplicationsBuilderProfile;
use app\modules\applications\models\ApplicationsPropertyApf;
use app\modules\applications\models\ApplicationsIndivProperty;
use app\modules\applications\models\ApplicationsNocSoc;

/**
 * ManageApplicationsController implements the CRUD actions for Applications model.
 */
class ManageApplicationsController extends Controller {

    const KYC_UPLOAD_DIR_NAME = "uploads/kyc/";
    const EXCEL_UPLOAD_DIR_NAME = "uploads/excelupload";
    const SAMPLE_TEMPLATE_DIR_NAME = "sample_templates";

    public $excel_columns_applications = array(
        'First Name' => 'first_name',
        'Middle Name' => 'middle_name',
        'Last Name' => 'last_name',
        'Date Of Birth' => 'date_of_birth',
        'Aadhaar Card No' => 'aadhaar_card_no',
        'Pan Card No' => 'pan_card_no',
        'Mobile No' => 'mobile_no',
        'Alternate Contact No' => 'alternate_contact_no',
        'Company Name' => 'company_name',
        'Address' => 'address',
        'Case Id' => 'case_id',
        'Branch Name' => 'branch',
        'Applicant Type' => 'applicant_type',
        'Profile Type' => 'profile_type',
        'Date Of Application' => 'date_of_application',
        'Residence Address' => 'resi_address',
        'Residence Pincode' => 'resi_address_pincode',
        'Residence Triggers' => 'resi_address_trigger',
        'Residence Send for verification' => 'resi_address_verification',
        'Office Address' => 'office_address',
        'Office Pincode' => 'office_address_pincode',
        'Office Triggers' => 'office_address_trigger',
        'Office Send for verification' => 'office_address_verification',
        'Business Address' => 'busi_address',
        'Business Pincode' => 'busi_address_pincode',
        'Business Triggers' => 'busi_address_trigger',
        'Business Send for verification' => 'busi_address_verification',
        'Resi/Office Address' => 'resi_office_address',
        'Resi/Office Pincode' => 'resi_office_address_pincode',
        'Resi/Office Triggers' => 'resi_office_address_trigger',
        'Resi/Office Send for verification' => 'resi_office_address_verification',
        'Builder Profile Address' => 'builder_profile_address',
        'Builder Profile Pincode' => 'builder_profile_address_pincode',
        'Builder Profile Triggers' => 'builder_profile_address_trigger',
        'Builder Profile Send for verification' => 'builder_profile_address_verification',
        'Property(APF) Address' => 'property_apf_address',
        'Property(APF) Pincode' => 'property_apf_address_pincode',
        'Property(APF) Triggers' => 'property_apf_address_trigger',
        'Property(APF) Send for verification' => 'property_apf_address_verification',
        'Individual Property Address' => 'indiv_property_address',
        'Individual Property Pincode' => 'indiv_property_address_pincode',
        'Individual Property Triggers' => 'indiv_property_address_trigger',
        'Individual Property Send for verification' => 'indiv_property_address_verification',
        'NOC (Society) Address' => 'noc_soc_address',
        'NOC (Society) Pincode' => 'noc_soc_address_pincode',
        'NOC (Society) Triggers' => 'noc_soc_address_trigger',
        'NOC (Society) Send for verification' => 'noc_soc_address_verification',
        'NOC (Business/Conditional) Address' => 'noc_address',
        'NOC (Business/Conditional) Pincode' => 'noc_address_pincode',
        'NOC (Business/Conditional) Triggers' => 'noc_address_trigger',
        'NOC (Business/Conditional) Send for verification' => 'noc_address_verification',
        'Profile ID' => 'profile_id',
    );
    public $excel_columns_applicant_profile = array(
        'First Name' => 'first_name',
        'Middle Name' => 'middle_name',
        'Last Name' => 'last_name',
        'Aadhaar Card No' => 'aadhaar_card_no',
        'Pan Card No' => 'pan_card_no',
        'Mobile No' => 'mobile_no',
        'Company Name' => 'company_name',
        'Address' => 'address',
    );

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
        $dataProvider->pagination = ['pageSize' => 10];

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
        $model = $this->findModel($id);
        $itrTable = $this->actionGetItrTable($id, 1);
        $nocTable = $this->actionGetNocTable($id, 1);
        $kycTable = $this->actionGetKycTable($id, $model->application_id, 1);
        $resiDocsTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 1, 2, 1);
        $resiPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 1, 1, 1);
        $busiDocsTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 2, 2, 1);
        $busiPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 2, 1, 1);
        $officePhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 3, 1, 1);
        $nocPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 4, 1, 1);
        $resiOfficePhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 5, 1, 1);
        $builderProfilePhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 6, 1, 1);
        $propertyApfPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 7, 1, 1);
        $indivPropertyPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 8, 1, 1);
        $nocSocPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 9, 1, 1);
        $applicationResi = ApplicationsResi::findOne(['application_id' => $id]);
        $applicationBusi = ApplicationsBusi::findOne(['application_id' => $id]);
        if (empty($applicationResi))
            $applicationResi = new ApplicationsResi();
        if (empty($applicationBusi))
            $applicationBusi = new ApplicationsBusi();
        return $this->render('view', [
                    'model' => $model,
                    'itrTable' => $itrTable,
                    'nocTable' => $nocTable,
                    'kycTable' => $kycTable,
                    'resiDocsTable' => $resiDocsTable,
                    'resiPhotosTable' => $resiPhotosTable,
                    'busiDocsTable' => $busiDocsTable,
                    'busiPhotosTable' => $busiPhotosTable,
                    'officePhotosTable' => $officePhotosTable,
                    'nocPhotosTable' => $nocPhotosTable,
                    'resiOfficePhotosTable' => $resiOfficePhotosTable,
                    'builderProfilePhotosTable' => $builderProfilePhotosTable,
                    'propertyApfPhotosTable' => $propertyApfPhotosTable,
                    'indivPropertyPhotosTable' => $indivPropertyPhotosTable,
                    'nocSocPhotosTable' => $nocSocPhotosTable,
                    'applicationResi' => $applicationResi,
                    'applicationBusi' => $applicationBusi,
        ]);
    }

    /**
     * Creates a new Applications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($profile_id = NULL) {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        $model = new Applications();
        $institutes = new Institutes();
        $loantypes = new LoanTypes();
        $area_model = new Area();
        if (!empty($profile_id)) {
            $applicant_profile = ApplicantProfile::find($profile_id)->one();
            $data = $applicant_profile->attributes;
            $model->setAttributes($data);
        }

        $errors = [];
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $post_data = Yii::$app->request->post();
            if (!empty($profile_id)) {
                $new_applicant_profile = new ApplicantProfile();
                $new_applicant_profile->attributes = $post_data['Applications'];
                $model->profile_id = $profile_id;
                $new_applicant_profile->save(FALSE);
            } else {
                #create profile
                $new_applicant_profile = new ApplicantProfile();
                $new_applicant_profile->first_name = $post_data['Applications']['first_name'];
                $new_applicant_profile->middle_name = $post_data['Applications']['middle_name'];
                $new_applicant_profile->last_name = $post_data['Applications']['last_name'];
                $new_applicant_profile->aadhaar_card_no = $post_data['Applications']['aadhaar_card_no'];
                $new_applicant_profile->pan_card_no = $post_data['Applications']['pan_card_no'];
                $new_applicant_profile->mobile_no = $post_data['Applications']['mobile_no'];
                $new_applicant_profile->alternate_contact_no = $post_data['Applications']['alternate_contact_no'];
                $new_applicant_profile->save(FALSE);

                $model->profile_id = $new_applicant_profile->id;
            }
            if ($model->save()) {
                #Save Application id
                $model->application_id = self::getApplicationId($model->id, $model->institute_id);
                $model->save();
                $step2 = isset($_REQUEST['step2']) ? $_REQUEST['step2'] : 0;
                return $this->redirect(['update', 'id' => $model->id, 'step2' => $step2]);
            }
        } else {
            $errors[] = $model->getErrors();
            return $this->render('create', [
                        'model' => $model,
                        'institutes' => $institutes,
                        'loantypes' => $loantypes,
                        'area_model' => $area_model,
                        'errors' => $errors,
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
        $pincode_master = new PincodeMaster();
        $applicationResi = ApplicationsResi::findOne(['application_id' => $id]);
        $applicationBusi = ApplicationsBusi::findOne(['application_id' => $id]);
        $applicationNocBusi = ApplicationsNocBusi::findOne(['application_id' => $id]);
        if (empty($applicationResi))
            $applicationResi = new ApplicationsResi();
        if (empty($applicationBusi))
            $applicationBusi = new ApplicationsBusi();       
        if (empty($applicationNocBusi))
            $applicationNocBusi = new ApplicationsNocBusi();
//        print_r($applicationResi);
//        die;
//        ApplicationsNocBusi
        //$area_model = new Area();
        $itrTable = $this->actionGetItrTable($id);
        $nocTable = $this->actionGetNocTable($id);
        $kycTable = $this->actionGetKycTable($id, $model->application_id, 0);
        $resiDocsTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 1, 2, 0);
        $resiPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 1, 1, 0);
        $busiDocsTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 2, 2, 0);
        $busiPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 2, 1, 0);
        $officePhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 3, 1, 0);
        $nocPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 4, 1, 0);
        $resiOfficePhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 5, 1, 0);
        $builderProfilePhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 6, 1, 0);
        $propertyApfPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 7, 1, 0);
        $indivPropertyPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 8, 1, 0);
        $nocSocPhotosTable = $this->actionGetDocsPhotosTable($id, $model->application_id, 9, 1, 0);

        $step2 = isset($_REQUEST['step2']) ? $_REQUEST['step2'] : 0;

        if (Yii::$app->request->post()) {
//            echo '<pre>';
//            print_r(Yii::$app->request->post());
//            die;
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            #Get checkbox values
            $applicationResi->resi_address_verification = isset($_POST['ApplicationsResi']['resi_address_verification'][0]) ? $_POST['ApplicationsResi']['resi_address_verification'][0] : 0;
            $model->office_address_verification = isset($_POST['Applications']['office_address_verification'][0]) ? $_POST['Applications']['office_address_verification'][0] : 0;
            $applicationBusi->busi_address_verification = isset($_POST['ApplicationsBusi']['busi_address_verification'][0]) ? $_POST['ApplicationsBusi']['busi_address_verification'][0] : 0;
            $applicationNocBusi->noc_address_verification = isset($_POST['ApplicationsNocBusi']['noc_address_verification'][0]) ? $_POST['ApplicationsNocBusi']['noc_address_verification'][0] : 0;
            $model->resi_office_address_verification = isset($_POST['Applications']['resi_office_address_verification'][0]) ? $_POST['Applications']['resi_office_address_verification'][0] : 0;
            $model->builder_profile_address_verification = isset($_POST['Applications']['builder_profile_address_verification'][0]) ? $_POST['Applications']['builder_profile_address_verification'][0] : 0;
            $model->property_apf_address_verification = isset($_POST['Applications']['property_apf_address_verification'][0]) ? $_POST['Applications']['property_apf_address_verification'][0] : 0;
            $model->indiv_property_address_verification = isset($_POST['Applications']['indiv_property_address_verification'][0]) ? $_POST['Applications']['indiv_property_address_verification'][0] : 0;
            $model->noc_soc_address_verification = isset($_POST['Applications']['noc_soc_address_verification'][0]) ? $_POST['Applications']['noc_soc_address_verification'][0] : 0;

            //Lat long
            if ($applicationResi->resi_address_verification == 1) {
                $latlong = array();
                $latlong = Applications::getLatLong($_POST['ApplicationsResi']['resi_address_pincode'], $_POST['ApplicationsResi']['resi_address']);

                if (!empty($latlong)) {
                    $applicationResi->resi_address_lat = $latlong['latitude'];
                    $applicationResi->resi_address_long = $latlong['longitude'];
                }
            }
            if ($applicationBusi->busi_address_verification == 1) {
                $latlong = array();
                $latlong = Applications::getLatLong($_POST['ApplicationsBusi']['busi_address_pincode'], $_POST['ApplicationsBusi']['busi_address']);

                if (!empty($latlong)) {
                    $applicationBusi->busi_address_lat = $latlong['latitude'];
                    $applicationBusi->busi_address_long = $latlong['longitude'];
                }
            }
            if ($model->office_address_verification == 1) {
                $latlong = array();
                $latlong = Applications::getLatLong($_POST['Applications']['office_address_pincode'], $_POST['Applications']['office_address']);

                if (!empty($latlong)) {
                    $model->office_address_lat = $latlong['latitude'];
                    $model->office_address_long = $latlong['longitude'];
                }
            }
            if ($applicationNocBusi->noc_address_verification == 1) {
                $latlong = array();
                $latlong = Applications::getLatLong($_POST['ApplicationsNocBusi']['noc_address_pincode'], $_POST['ApplicationsNocBusi']['noc_address']);

                if (!empty($latlong)) {
                    $applicationNocBusi->noc_address_lat = $latlong['latitude'];
                    $applicationNocBusi->noc_address_long = $latlong['longitude'];
                }
            }
            if ($model->resi_office_address_verification == 1) {
                $latlong = array();
                $latlong = Applications::getLatLong($_POST['Applications']['resi_office_address_pincode'], $_POST['Applications']['resi_office_address']);

                if (!empty($latlong)) {
                    $model->resi_office_address_lat = $latlong['latitude'];
                    $model->resi_office_address_long = $latlong['longitude'];
                }
            }
            if ($model->builder_profile_address_verification == 1) {
                $latlong = array();
                $latlong = Applications::getLatLong($_POST['Applications']['builder_profile_address_pincode'], $_POST['Applications']['builder_profile_address']);

                if (!empty($latlong)) {
                    $model->builder_profile_address_lat = $latlong['latitude'];
                    $model->builder_profile_address_long = $latlong['longitude'];
                }
            }
            if ($model->property_apf_address_verification == 1) {
                $latlong = array();
                $latlong = Applications::getLatLong($_POST['Applications']['property_apf_address_pincode'], $_POST['Applications']['property_apf_address']);

                if (!empty($latlong)) {
                    $model->property_apf_address_lat = $latlong['latitude'];
                    $model->property_apf_address_long = $latlong['longitude'];
                }
            }
            if ($model->indiv_property_address_verification == 1) {
                $latlong = array();
                $latlong = Applications::getLatLong($_POST['Applications']['indiv_property_address_pincode'], $_POST['Applications']['indiv_property_address']);

                if (!empty($latlong)) {
                    $model->indiv_property_address_lat = $latlong['latitude'];
                    $model->indiv_property_address_long = $latlong['longitude'];
                }
            }
            if ($model->noc_soc_address_verification == 1) {
                $latlong = array();
                $latlong = Applications::getLatLong($_POST['Applications']['noc_soc_address_pincode'], $_POST['Applications']['noc_soc_address']);

                if (!empty($latlong)) {
                    $model->noc_soc_address_lat = $latlong['latitude'];
                    $model->noc_soc_address_long = $latlong['longitude'];
                }
            }
            $model->load(Yii::$app->request->post());
            if (!empty($_POST['ApplicationsResi']['resi_not_reachable_remarks']))
                $applicationResi->resi_not_reachable_remarks = str_replace("\n", PHP_EOL, $_POST['ApplicationsResi']['resi_not_reachable_remarks']);
            if (!empty($_POST['ApplicationsBusi']['busi_not_reachable_remarks']))
                $applicationBusi->busi_not_reachable_remarks = str_replace("\n", PHP_EOL, $_POST['ApplicationsBusi']['busi_not_reachable_remarks']);
            if (!empty($_POST['Applications']['office_not_reachable_remarks']))
                $model->office_not_reachable_remarks = str_replace("\n", PHP_EOL, $_POST['Applications']['office_not_reachable_remarks']);
            if (!empty($_POST['ApplicationsNocBusi']['noc_not_reachable_remarks']))
                $applicationNocBusi->noc_not_reachable_remarks = str_replace("\n", PHP_EOL, $_POST['ApplicationsNocBusi']['noc_not_reachable_remarks']);
            if (!empty($_POST['Applications']['resi_office_not_reachable_remarks']))
                $model->resi_office_not_reachable_remarks = str_replace("\n", PHP_EOL, $_POST['Applications']['resi_office_not_reachable_remarks']);
            if (!empty($_POST['Applications']['builder_profile_not_reachable_remarks']))
                $model->builder_profile_not_reachable_remarks = str_replace("\n", PHP_EOL, $_POST['Applications']['builder_profile_not_reachable_remarks']);
            if (!empty($_POST['Applications']['property_apf_not_reachable_remarks']))
                $model->property_apf_not_reachable_remarks = str_replace("\n", PHP_EOL, $_POST['Applications']['property_apf_not_reachable_remarks']);
            if (!empty($_POST['Applications']['indiv_property_not_reachable_remarks']))
                $model->indiv_property_not_reachable_remarks = str_replace("\n", PHP_EOL, $_POST['Applications']['indiv_property_not_reachable_remarks']);
            if (!empty($_POST['Applications']['noc_soc_not_reachable_remarks']))
                $model->noc_soc_not_reachable_remarks = str_replace("\n", PHP_EOL, $_POST['Applications']['noc_soc_not_reachable_remarks']);
          
            if ($model->save()) {
                if (isset($_POST['ApplicationsResi']) AND ! empty($_POST['ApplicationsResi'])) {
                    $applicationResi->attributes = $_POST['ApplicationsResi'];
                    $applicationResi->application_id = $id;
                    $applicationResi->save();
                }
                if (isset($_POST['ApplicationsBusi']) AND ! empty($_POST['ApplicationsBusi'])) {
                    $applicationBusi->attributes = $_POST['ApplicationsBusi'];
                    $applicationBusi->application_id = $id;
                    $applicationBusi->save();
                }
                if (isset($_POST['ApplicationsNocBusi']) AND ! empty($_POST['ApplicationsNocBusi'])) {
                    $applicationNocBusi->attributes = $_POST['ApplicationsNocBusi'];
                    $applicationNocBusi->application_id = $id;
                    $applicationNocBusi->save();
//                    if(!$applicationNocBusi->save()){
//                        echo "<pre/>",print_r($applicationNocBusi->getErrors());die;
//                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $errors[] = $model->getErrors();
                return $this->render('update', [
                            'model' => $model,
                            'step2' => $step2,
                            'institutes' => $institutes,
                            'loantypes' => $loantypes,
                            'pincode_master' => $pincode_master,
                            'itrTable' => $itrTable,
                            'nocTable' => $nocTable,
                            'kycTable' => $kycTable,
                            'resiDocsTable' => $resiDocsTable,
                            'resiPhotosTable' => $resiPhotosTable,
                            'busiDocsTable' => $busiDocsTable,
                            'busiPhotosTable' => $busiPhotosTable,
                            'officePhotosTable' => $officePhotosTable,
                            'nocPhotosTable' => $nocPhotosTable,
                            'resiOfficePhotosTable' => $resiOfficePhotosTable,
                            'builderProfilePhotosTable' => $builderProfilePhotosTable,
                            'propertyApfPhotosTable' => $propertyApfPhotosTable,
                            'indivPropertyPhotosTable' => $indivPropertyPhotosTable,
                            'nocSocPhotosTable' => $nocSocPhotosTable,
                            'applicationResi' => $applicationResi,
                            'applicationBusi' => $applicationBusi,
                            'applicationNocBusi' => $applicationNocBusi
                ]);
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'step2' => $step2,
                        'institutes' => $institutes,
                        'loantypes' => $loantypes,
                        'pincode_master' => $pincode_master,
                        'itrTable' => $itrTable,
                        'nocTable' => $nocTable,
                        'kycTable' => $kycTable,
                        'resiDocsTable' => $resiDocsTable,
                        'resiPhotosTable' => $resiPhotosTable,
                        'busiDocsTable' => $busiDocsTable,
                        'busiPhotosTable' => $busiPhotosTable,
                        'officePhotosTable' => $officePhotosTable,
                        'nocPhotosTable' => $nocPhotosTable,
                        'resiOfficePhotosTable' => $resiOfficePhotosTable,
                        'builderProfilePhotosTable' => $builderProfilePhotosTable,
                        'propertyApfPhotosTable' => $propertyApfPhotosTable,
                        'indivPropertyPhotosTable' => $indivPropertyPhotosTable,
                        'nocSocPhotosTable' => $nocSocPhotosTable,
                        'nocSocPhotosTable' => $nocSocPhotosTable,
                        'applicationResi' => $applicationResi,
                        'applicationBusi' => $applicationBusi,
                        'applicationNocBusi' => $applicationNocBusi
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

    public function actionGetItrTable($id, $getHtml = 0) {

        $itrs = Itr::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();

        $return_html = '<table  class="table table-hover small-text" id="itr_table">
                        <tr class="tr-header">
                            <th>Total Income</th>
                            <th>Date of Filing</th>
                            <th>Pan no.</th>
                            <th>Acknowledgement No.</th>
                            <th>Assesement year (YYYY-YYYY)</th>
                            <th>Remarks</th>';
        $colspan = 6;
        if ($getHtml == 0) {
            $return_html .= '<th><button type="button" class="btn btn-primary addMoreItr"><i class="fa fa-plus"></i></button></th>';
            $colspan = 7;
        }
        $return_html .= '</tr>';
        if (!empty($itrs)) {
            foreach ($itrs as $itr_data) {
                $return_html .= '<tr>';
                $return_html .= '<td>' . $itr_data['total_income'] . '</td>';
                $return_html .= '<td>' . $itr_data['date_of_filing'] . '</td>';
                $return_html .= '<td>' . $itr_data['pan_card_no'] . '</td>';
                $return_html .= '<td>' . $itr_data['acknowledgement_no'] . '</td>';
                $return_html .= '<td>' . $itr_data['assessment_year'] . '</td>';
                $return_html .= '<td>' . $itr_data['remarks'] . '</td>';
                if ($getHtml == 0) {
                    $return_html .= '<td><button type="button" class="btn btn-danger deleteItr" value="' . $itr_data['id'] . '"><i class="fa fa-trash-o"></i></button></td>';
                }
                $return_html .= '</tr>';
            }
        } else {
            $return_html .= '<tr>';
            $return_html .= '<td colspan=' . $colspan . '>No records Found!!!</td>';
            $return_html .= '</tr>';
        }

        $return_html .= '</table>';

        return $return_html;
    }

    public function actionAddItr() {
        if (!empty($_POST)) {
            $data = $_POST;

            $application_id = $data['application_id'];
            $total_income = $data['total_income'];
            $date_of_filing = $data['date_of_filing'];
            $pan_card_no = $data['pan_card_no'];
            $acknowledgement_no = $data['acknowledgement_no'];
            $assessment_year = $data['assessment_year'];
            $created_by = Yii::$app->user->id;

            #Add data to noc
            $itr_model = new Itr();

            $itr_model->application_id = $application_id;
            $itr_model->total_income = $total_income;
            $itr_model->date_of_filing = $date_of_filing;
            $itr_model->pan_card_no = $pan_card_no;
            $itr_model->acknowledgement_no = $acknowledgement_no;
            $itr_model->assessment_year = $assessment_year;
            $itr_model->created_by = $created_by;
            $itr_model->save(FALSE);

            return 'Successfully Added!!!';
        }
        return 'Something went wrong!!!';
    }

    public function actionDeleteItr() {
        if (!empty($_POST)) {
            $id = $_POST['record_id'];

            $itr_model = Itr::findOne($id);

            $itr_model->is_deleted = 1;

            $itr_model->save();
        }
    }

    public function getItrTableHtml($id) {
        $itrs = Itr::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();

        $return_html = '<table class="table table-hover small-text">
                        <tr class="tr-header">
                            <th>Total Income</th>
                            <th>Date of Filing</th>
                            <th>Pan no.</th>
                            <th>Acknowledgement No.</th>
                            <th>Assesement year (YYYY-YYYY)</th>
                            <th>Remarks</th>';
        $return_html .= '</tr>';
        if (!empty($itrs)) {
            foreach ($itrs as $itr_data) {
                $return_html .= '<tr>';
                $return_html .= '<td>' . $itr_data['total_income'] . '></td>';
                $return_html .= '<td>' . $itr_data['date_of_filing'] . '</td>';
                $return_html .= '<td>' . $itr_data['pan_card_no'] . '</td>';
                $return_html .= '<td>' . $itr_data['acknowledgement_no'] . '</td>';
                $return_html .= '<td>' . $itr_data['assessment_year'] . '</td>';
                $return_html .= '<td>' . $itr_data['remarks'] . '</td>';
                $return_html .= '</tr>';
            }
        } else {
            $return_html .= '<tr>';
            $return_html .= '<td colspan=6>No records Found!!!</td>';
            $return_html .= '</tr>';
        }

        $return_html .= '</table>';

        return $return_html;
    }

    public function actionGetNocTable($id, $getHtml = 0) {

        $nocs = Noc::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();

        $return_html = '<table  class="table table-hover small-text" id="noc_table">
                        <tr class="tr-header">
                            <th>Met Person</th>
                            <th>Designation</th>
                            <th>Remarks</th>';
        $colspan = 3;
        if ($getHtml == 0) {
            $return_html .= '<th><button type="button" class="btn btn-primary addMoreNoc"><i class="fa fa-plus"></i></button></th>';
            $colspan = 4;
        }
        $return_html .= '</tr>';
        if (!empty($nocs)) {
            foreach ($nocs as $noc_data) {
                $return_html .= '<tr>';
                $return_html .= '<td>' . $noc_data['met_person'] . '</td>';
                $return_html .= '<td>' . $noc_data['designation'] . '</td>';
                $return_html .= '<td>' . $noc_data['remarks'] . '</td>';
                if ($getHtml == 0) {
                    $return_html .= '<td><button type="button" class="btn btn-danger deleteNoc" value="' . $noc_data['id'] . '"><i class="fa fa-trash-o"></i></button></td>';
                }
                $return_html .= '</tr>';
            }
        } else {
            $return_html .= '<tr>';
            $return_html .= '<td colspan=' . $colspan . '>No records Found!!!</td>';
            $return_html .= '</tr>';
        }

        $return_html .= '</table>';

        return $return_html;
    }

    public function actionAddNoc() {
        if (!empty($_POST)) {
            $data = $_POST;

            $application_id = $data['application_id'];
            $met_person = $data['noc_met_person'];
            $designation = $data['noc_designation'];
            $remarks = $data['noc_remarks'];
            $created_by = Yii::$app->user->id;

            #Add data to noc
            $noc_model = new Noc();

            $noc_model->application_id = $application_id;
            $noc_model->met_person = $met_person;
            $noc_model->designation = $designation;
            $noc_model->remarks = $remarks;
            $noc_model->created_by = $created_by;
            $noc_model->save(FALSE);

            return 'Successfully Added!!!';
        }
        return 'Something went wrong!!!';
    }

    public function actionDeleteNoc() {
        if (!empty($_POST)) {
            $id = $_POST['record_id'];

            $noc_model = Noc::findOne($id);

            $noc_model->is_deleted = 1;

            $noc_model->save();
        }
    }

    public function actionGetKycTable($id, $application_id, $getHtml, $isAjaxCall = NULL) {

        $nocs = Kyc::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();

        $return_html = '';

        $return_html .= '<table class="table table-striped table-bordered">
                        <thead>
                        <tr class="tr-header">
                            <th>Preview</th>
                            <th>Doc type</th>
                            <th>Remarks</th>
                            <th>Send For<br>Verification</th>';
        if ($getHtml == 0) {
            $return_html .= '<th><button type="button" class="btn btn-primary" id="addMoreKyc"><i class="fa fa-plus"></i></button></th>';
        }
        $return_html .= '</tr></thead>';
        if (!empty($nocs)) {
            foreach ($nocs as $noc_data) {
                $image_link = '<a href="#" class="pop_kyc"><img src="' . Yii::$app->request->BaseUrl . '/' . self::KYC_UPLOAD_DIR_NAME . $application_id . '/thumbs/' . $noc_data['file_name'] . '" class="user-image" alt="KYC Image" width="40"></a>';
                $return_html .= '<tr>';
                $return_html .= '<td>' . $image_link . '</td>';
                $return_html .= '<td>' . $noc_data['doc_type'] . '</td>';
                $return_html .= '<td>' . $noc_data['remarks'] . '</td>';

                if ($getHtml == 0) {
                    $checked = '';
                    if ($noc_data['send_for_verification']) {
                        $checked = 'checked';
                    }
                    $return_html .= '<td><input type="checkbox" class="checkKyc" id="kyc_check_' . $noc_data['id'] . '" name="kyc_check_' . $noc_data['id'] . '" value="' . $noc_data['id'] . '" ' . $checked . '></td>';
                    $return_html .= '<td align="center"><button type="button" class="btn btn-danger deleteKyc" value="' . $noc_data['id'] . '"><i class="fa fa-trash-o"></i></button></td>';
                } else {
                    $print = $noc_data['send_for_verification'] == 1 ? "TRUE" : "FALSE";
                    $return_html .= '<td>' . $print . '</td>';
                }
                $return_html .= '</tr>';
            }
        } else {
            $colspan = 4;
            if ($getHtml == 0) {
                $colspan = 5;
            }
            $return_html .= '<tr>';
            $return_html .= '<td colspan="' . $colspan . '">No records Found!!!</td>';
            $return_html .= '</tr>';
        }

        $return_html .= '</table>';

        if (!empty($isAjaxCall)) {
            echo $return_html;
        } else {
            return $return_html;
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
            if (!empty($data['inputCompanyName'])) {
                $query_condition["company_name"] = $data['inputCompanyName'];
            }
            if (!empty($data['inputAddress'])) {
                $query_condition["address"] = $data['inputAddress'];
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
                           <th>Company Name</th>
                           <th>Address</th>
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
                    $return_data .= "<td>{$app_profile['company_name']}</td>";
                    $return_data .= "<td>{$app_profile['address']}</td>";
                    $return_data .= '<td><button style="margin-bottom: 10px !important;" type="button" class="btn btn-primary btn_select_record" value="' . $app_profile['id'] . '" rel="' . $app_profile['first_name'] . '_' . $app_profile['middle_name'] . '_' . $app_profile['last_name'] . '">
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

    public function getApplicationId($id, $institute_id = NULL) {
        $short_form = '';
        if (!empty($institute_id)) {
            $institute_data = Institutes::findOne($institute_id);
            if (!empty($institute_data)) {
                $short_form = $institute_data->abbreviation;
            }
        }
        $curr_data = date('dmy');
        $prefix = 'ACS' . $short_form;
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

            $dirname = self::KYC_UPLOAD_DIR_NAME . $application_number;
            if (!file_exists($dirname)) {
                mkdir($dirname);
                mkdir($dirname . '/thumbs');
            }

            if (isset($_FILES['kyc_file'])) {
                $errors = array();
                $file_name = $_FILES['kyc_file']['name'];
                $newfile_name = date('dmYHis') . $_FILES['kyc_file']['name'];
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
                    if (move_uploaded_file($file_tmp, $dirname . '/' . $newfile_name)) {
                        #Create Thumbnail
                        $upload_img = Applications::thumbnailCreator($newfile_name, $dirname, 'thumbs', '200', '160', $file_tmp, $file_ext);

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

    public function actionPhotosKyc() {
        if (!empty($_POST)) {
            echo '<pre>';
            print_r($_POST);
        }
    }

    public function actionDeleteKyc() {
        if (!empty($_POST)) {
            $kyc_id = $_POST['kyc_id'];
            $application_number = $_POST['application_id'];

            $kyc_model = Kyc::findOne($kyc_id);
            $file_name = $kyc_model->file_name;
            $dirname = self::KYC_UPLOAD_DIR_NAME . $application_number;

            $file_path = $dirname . '/' . $file_name;
            $thumb_path = $dirname . '/thumbs/' . $file_name;

            @unlink($file_path);
            @unlink($thumb_path);

            $kyc_model->is_deleted = 1;

            $kyc_model->save();
        }
    }

    public function actionSendKycForVerification() {
        if (!empty($_POST)) {
            $kyc_id = $_POST['kyc_id'];
            $checkboxchecked = $_POST['checkboxchecked'];
            $kyc_model = Kyc::findOne($kyc_id);

            $kyc_model->send_for_verification = $checkboxchecked;

            $kyc_model->save();
        }
    }

    public function actionGetDocsPhotosTable($id, $application_id, $section, $type, $getHtml, $isAjaxCall = NULL) {
        $photos = ApplicantPhotos::find()->where(['application_id' => $id, 'section' => $section, 'type' => $type, 'is_deleted' => '0'])->all();

        $return_html = '';

        $return_html .= '<table class="table table-striped table-bordered">
                        <thead>
                        <tr class="tr-header">
                            <th class="text-center">Preview</th>
                            <th class="text-center">Remarks</th>
                            <th class="text-center">Location</th>';
        if ($getHtml == 0) {
            $return_html .= '<th class="text-center"><button type="button" class="btn btn-primary addMorePhotos" value="' . $section . '_' . $type . '"><i class="fa fa-plus"></i></button></th>';
        }
        $return_html .= '</tr></thead>';
        if (!empty($photos)) {
            foreach ($photos as $photos_data) {
                $image_link = '<a href="#" class="pop_kyc"><img src="' . Yii::$app->request->BaseUrl . '/' . self::KYC_UPLOAD_DIR_NAME . $application_id . '/thumbs/' . $photos_data['file_name'] . '" class="user-image" alt="Image" width="40"></a>';
                $return_html .= '<tr>';
                $return_html .= '<td align="center">' . $image_link . '</td>';
                $return_html .= '<td>' . $photos_data['remarks'] . '</td>';
                $return_html .= '<td align="center"><button type="button" class="btn btn-info photoViewLocation" value="' . $photos_data['id'] . '"><i class="fa fa-map-marker"></i></button></td>';

                if ($getHtml == 0) {
                    $return_html .= '<td align="center"><button type="button" class="btn btn-danger deletePhotos" value="' . $photos_data['id'] . '_' . $photos_data['section'] . '_' . $photos_data['type'] . '"><i class="fa fa-trash-o"></i></button></td>';
                }
                $return_html .= '</tr>';
            }
        } else {
            $colspan = 3;
            if ($getHtml == 0) {
                $colspan = 4;
            }
            $return_html .= '<tr>';
            $return_html .= '<td colspan="' . $colspan . '">No records Found!!!</td>';
            $return_html .= '</tr>';
        }

        $return_html .= '</table>';

        if (!empty($isAjaxCall)) {
            echo $return_html;
        } else {
            return $return_html;
        }
    }

    public function actionUploadPhotos() {
        if (!empty($_POST)) {
            $data = $_POST;

            $application_number = $data['application_number'];
            $photos_remarks = $data['photos_remarks'];
            $application_id = $data['application_id'];
            $photos_section = $data['photos_section'];
            $photos_type = $data['photos_type'];

            $dirname = self::KYC_UPLOAD_DIR_NAME . $application_number;
            if (!file_exists($dirname)) {
                mkdir($dirname);
                mkdir($dirname . '/thumbs');
            }

            if (isset($_FILES['photos_file'])) {
                $errors = array();
                $file_name = $_FILES['photos_file']['name'];
                $newfile_name = date('dmYHis') . $_FILES['photos_file']['name'];
                $file_size = $_FILES['photos_file']['size'];
                $file_tmp = $_FILES['photos_file']['tmp_name'];
                $file_type = $_FILES['photos_file']['type'];

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
                    if (move_uploaded_file($file_tmp, $dirname . '/' . $newfile_name)) {
                        #Create Thumbnail
                        $upload_img = Applications::thumbnailCreator($newfile_name, $dirname, 'thumbs', '200', '160', $file_tmp, $file_ext);

                        #Add data to kyc
                        $ap_model = new ApplicantPhotos();

                        $ap_model->application_id = $application_id;
                        $ap_model->remarks = $photos_remarks;
                        $ap_model->file_name = $newfile_name;
                        $ap_model->section = $photos_section;
                        $ap_model->type = $photos_type;

                        $ap_model->save(FALSE);

                        echo "Upload Successful";
                    } else {
                        echo "Something went wrong!!!";
                    }
                } else {
                    print_r($errors);
                }
            } else {
                echo 'Something went wrong!!!';
            }
        }
    }

    public function actionDeletePhotos() {
        if (!empty($_POST)) {
            $record_id = $_POST['record_id'];
            $application_number = $_POST['application_id'];

            $ap_model = ApplicantPhotos::findOne($record_id);
            $file_name = $ap_model->file_name;
            $dirname = self::KYC_UPLOAD_DIR_NAME . $application_number;

            $file_path = $dirname . '/' . $file_name;
            $thumb_path = $dirname . '/thumbs/' . $file_name;

            @unlink($file_path);
            @unlink($thumb_path);

            $ap_model->is_deleted = 1;

            $ap_model->save();
        }
    }

    public function getVerifierDropdown($app_id, $verification_type, $is_manage) {
        $selected_id = self::checkVerifierForApplicationExist($app_id, $verification_type);
        $allVerifiers_data = TblMobileUsers::find()->asArray()->all();
        $disabled = '';
        if ($is_manage == 0) {
            $disabled = 'disabled';
        }
        $return_html = '';
        $return_html .= '<label class="control-label">Select Verifier</label>';
        $return_html .= '<select class="form-control" id="verifier_' . $verification_type . '" ' . $disabled . '>';
        $return_html .= '<option value="">Select Verifier</option>';
        if (!empty($allVerifiers_data)) {
            foreach ($allVerifiers_data as $allVerifiers) {
                $selected = isset($selected_id['mobile_user_id']) ? (($selected_id['mobile_user_id'] == $allVerifiers['id']) ? 'selected' : '') : '';
                $return_html .= '<option value ="' . $allVerifiers['id'] . '" ' . $selected . '>';
                $return_html .= $allVerifiers['field_agent_name'];
                $return_html .= '</option>';
            }
        }
        $return_html .= '</select>';
        return $return_html;
    }

    public function checkVerifierForApplicationExist($app_id, $verification_type) {
        $return_data = array();
        $verifiers_data = ApplicationsVerifiers::find()->where(['application_id' => $app_id, 'verification_type' => $verification_type, 'is_deleted' => '0'])->one();

        if (!empty($verifiers_data)) {
            $return_data['mobile_user_id'] = $verifiers_data->mobile_user_id;
            $return_data['id'] = $verifiers_data->id;
        }
        return $return_data;
    }

    public function actionGetVerifier() {
        $return_html = '';

        if (!empty($_POST)) {
            $app_id = $_POST['app_id'];
            $is_manage = $_POST['is_manage'];
            $applications_model = Applications::findOne($app_id);
            $applicationResi = ApplicationsResi::findOne(['application_id' => $app_id]);
            $applicationBusi = ApplicationsBusi::findOne(['application_id' => $app_id]);
            $applicationNocBusi = ApplicationsNocBusi::findOne(['application_id' => $app_id]);
            if (empty($applicationResi))
                $applicationResi = new ApplicationsResi();
            
            if (empty($applicationBusi))
                $applicationBusi = new ApplicationsBusi();  
            
            if (empty($applicationNocBusi))
                $applicationNocBusi = new ApplicationsNocBusi();
            
            if ($applicationResi->resi_address_verification == 1 ||
                    $applicationBusi->busi_address_verification == 1 ||
                    $applications_model->office_address_verification == 1 ||
                    $applicationNocBusi->noc_address_verification == 1 ||
                    $applications_model->resi_office_address_verification == 1 ||
                    $applications_model->builder_profile_address_verification == 1 ||
                    $applications_model->property_apf_address_verification == 1 ||
                    $applications_model->indiv_property_address_verification == 1 ||
                    $applications_model->noc_soc_address_verification == 1
            ) {
                if ($applicationResi->resi_address_verification == 1) {
                    self::verifierModalRow($app_id, 1, $applicationResi, 'resi_address_pincode', $is_manage, $return_html);
                }
                if ($applicationBusi->busi_address_verification == 1) {
                    self::verifierModalRow($app_id, 2, $applicationBusi, 'busi_address_pincode', $is_manage, $return_html);
                }
                if ($applications_model->office_address_verification == 1) {
                    self::verifierModalRow($app_id, 3, $applications_model, 'office_address_pincode', $is_manage, $return_html);
                }
                if ($applicationNocBusi->noc_address_verification == 1) {
                    self::verifierModalRow($app_id, 4, $applicationNocBusi, 'noc_address_pincode', $is_manage, $return_html);
                }
                if ($applications_model->resi_office_address_verification == 1) {
                    self::verifierModalRow($app_id, 5, $applications_model, 'resi_office_address_pincode', $is_manage, $return_html);
                }
                if ($applications_model->builder_profile_address_verification == 1) {
                    self::verifierModalRow($app_id, 6, $applications_model, 'builder_profile_address_pincode', $is_manage, $return_html);
                }
                if ($applications_model->property_apf_address_verification == 1) {
                    self::verifierModalRow($app_id, 7, $applications_model, 'property_apf_address_pincode', $is_manage, $return_html);
                }
                if ($applications_model->indiv_property_address_verification == 1) {
                    self::verifierModalRow($app_id, 8, $applications_model, 'indiv_property_address_pincode', $is_manage, $return_html);
                }
                if ($applications_model->noc_soc_address_verification == 1) {
                    self::verifierModalRow($app_id, 9, $applications_model, 'noc_soc_address_pincode', $is_manage, $return_html);
                }
            } else {
                $return_html .= '<div><h4 style="color:#e70606;font-weight:bold">Please select "Send for verification" option for any Address Verification</h4></div>';
            }
            return $return_html;
        }
    }

    public function verifierModalRow($app_id, $verification_type, $applications_model, $pincode, $is_manage, &$return_html) {
        switch ($verification_type) {
            case 2 :
                $address_name = 'Business';
                break;
            case 3 :
                $address_name = 'Office';
                break;
            case 4 :
                $address_name = 'NOC (Business/Conditional)';
                break;
            case 5 :
                $address_name = 'Residence/Office';
                break;
            case 6 :
                $address_name = 'Builder Profile';
                break;
            case 7 :
                $address_name = 'Property(APF)';
                break;
            case 8 :
                $address_name = 'Individual Property';
                break;
            case 9 :
                $address_name = 'NOC (Society)';
                break;
            default :
                $address_name = 'Residence';
                break;
        }
        $return_html .= '<div><h4><strong>' . $address_name . ' Address</strong></h4></div>';
        $return_html .= '<div class="row">';
        $return_html .= '<div class="col-lg-4"><label class="control-label" for="name" style=" margin-top: 0px;">' . $applications_model->getAttributeLabel($pincode) . '</label>
    <div class="readonlydiv">' . $applications_model->$pincode . '</div></div>';
        $return_html .= '<div class="col-lg-4">' . self::getVerifierDropdown($app_id, $verification_type, $is_manage) . '</div>';
        if ($is_manage) {
            $return_html .= '<div class="col-lg-4" id="type_' . $verification_type . '"><label class="control-label">Actions</label><br>';
            $ifverexist = self::checkVerifierForApplicationExist($app_id, $verification_type);
            if (!empty($ifverexist)) {
                $return_html .= '<button type="button" class="btn btn-primary update_app_verifier" value="' . $ifverexist['id'] . '_' . $verification_type . '"><i class="fa fa-pencil"></i> Update</button> ';
                $return_html .= '<button type="button" class="btn btn-danger delete_app_verifier" value="' . $ifverexist['id'] . '_' . $verification_type . '_' . $app_id . '"><i class="fa fa-times"></i> Delete</button>';
            } else {
                $return_html .= '<button type="button" class="btn btn-success add_app_verifier" value="' . $app_id . '_' . $verification_type . '"><i class="fa fa-plus"></i> Add</button>';
            }
            $return_html .= '</div>';
        } else {
            $return_html .= '<div class="col-lg-4"></div>';
        }

        $return_html .= '</div>';
        $return_html .= '<div class="row">';
        $return_html .= '<div class="col-lg-4"></div>';
        $return_html .= '<div class="col-lg-4"></div>';
        $return_html .= '<div class="col-lg-4">';
        $return_html .= self::getRevokedStatus($app_id, $verification_type);
        $return_html .= '</div>';
        $return_html .= '</div>';
    }

    public function getRevokedStatus($app_id, $verification_type) {
        $return_data = '';
        $verifiers_data = ApplicationsVerifiersRevoked::find()->where(['application_id' => $app_id, 'verification_type' => $verification_type])->one();

        if (!empty($verifiers_data)) {
            $return_data = '<span style="color:#ff6c60;font-weight:bold">Site Revoked</span>';
        }

        return $return_data;
    }

    public function actionUpdateVerifier() {
        $response_data = array();
        $response_data['msg'] = 'Something went wrong!!!';
        $response_data['status'] = 'failure';
        if (!empty($_POST)) {
            $veriid = $_POST['veriid'];
            $m_user_id = $_POST['m_user_id'];
            $verification_type = $_POST['verification_type'];

            $verifiers_data = ApplicationsVerifiers::findOne($veriid);
            $verifiers_data->mobile_user_id = $m_user_id;
            $verifiers_data->save();

            $response_data['msg'] = 'Verifier Assignment updated sucessfully!!!';
            $response_data['status'] = 'success';
            $response_data['html'] = self::getButtons($verification_type, $veriid, 'update', $verifiers_data->application_id);
        }
        echo json_encode($response_data);
    }

    public function actionDeleteVerifier() {
        $response_data = array();
        $response_data['msg'] = 'Something went wrong!!!';
        $response_data['status'] = 'failure';
        if (!empty($_POST)) {
            $veriid = $_POST['veriid'];
            $verification_type = $_POST['verification_type'];
            $app_id = $_POST['app_id'];

            $verifiers_data = ApplicationsVerifiers::findOne($veriid)->delete();
            $response_data['msg'] = 'Verifier Assignment deleted sucessfully!!!';
            $response_data['status'] = 'success';
            $response_data['html'] = self::getButtons($verification_type, $app_id, 'delete');
        }
        echo json_encode($response_data);
    }

    public function actionAddVerifier() {
        $response_data = array();
        $response_data['msg'] = 'Something went wrong!!!';
        $response_data['status'] = 'failure';
        if (!empty($_POST)) {
            $m_user_id = $_POST['m_user_id'];
            $app_id = $_POST['app_id'];
            $verification_type = $_POST['verification_type'];

            $verifiers_data = new ApplicationsVerifiers();
            $verifiers_data->application_id = $app_id;
            $verifiers_data->verification_type = $verification_type;
            $verifiers_data->mobile_user_id = $m_user_id;
            $verifiers_data->mobile_user_assigned_date = date('Y-m-d H:i:s');
            $verifiers_data->save();

            $response_data['msg'] = 'Verifier Assignment done sucessfully!!!';
            $response_data['status'] = 'success';
            $response_data['html'] = self::getButtons($verification_type, $verifiers_data->id, 'add', $app_id);
        }
        echo json_encode($response_data);
    }

    public function getButtons($verification_type, $id, $actiontype, $app_id = '') {
        $return_html = '';
        $return_html .= '<label class="control-label">Actions</label><br>';
        if ($actiontype == 'update' || $actiontype == 'add') {
            $return_html .= '<button type="button" class="btn btn-primary update_app_verifier" value="' . $id . '_' . $verification_type . '"><i class="fa fa-pencil"></i> Update</button> ';
            $return_html .= '<button type="button" class="btn btn-danger delete_app_verifier" value="' . $id . '_' . $verification_type . '_' . $app_id . '"><i class="fa fa-times"></i> Delete</button>';
        } else {
            $return_html .= '<button type="button" class="btn btn-success add_app_verifier" value="' . $id . '_' . $verification_type . '"><i class="fa fa-plus"></i> Add</button>';
        }
        return $return_html;
    }

    public function actionUploadApplications() {
        $institutes = ArrayHelper::map(Institutes::find()->orderBy('name')->all(), 'id', 'name');
        $loantypes = ArrayHelper::map(LoanTypes::find()->orderBy('loan_name')->all(), 'id', 'loan_name');
        $model = new ApplicationsUploads();
        return $this->render('upload_applications', [
                    'model' => $model,
                    'institutes' => $institutes,
                    'loantypes' => $loantypes,
        ]);
    }

    public function actionUploadApplicationsExcel() {
        $response_data = array();
        try {
            if (!empty($_POST)) {
                $data = $_POST;
                $institute_id = $data['institute_id'];
                $loan_type_id = $data['loan_type_id'];

                $dirname = self::EXCEL_UPLOAD_DIR_NAME;
                if (isset($_FILES['upe_file'])) {
                    $errors = '';
                    $file_name = $_FILES['upe_file']['name'];
                    $newfile_name = date('dmYHis') . $_FILES['upe_file']['name'];
                    $file_size = $_FILES['upe_file']['size'];
                    $file_tmp = $_FILES['upe_file']['tmp_name'];
                    $file_type = $_FILES['upe_file']['type'];

                    $file_name_exploded = explode('.', $file_name);
                    $file_ext = strtolower(end($file_name_exploded));

                    $expensions = array("xlsx");

                    if (in_array($file_ext, $expensions) === false) {
                        $errors .= "Extension not allowed, please choose a XLSX file.";
                    }

                    if ($file_size > 2097152) {
                        $errors .= 'File size must not exceed 2 MB';
                    }

                    if (empty($errors) == true) {
                        if (move_uploaded_file($file_tmp, $dirname . '/' . $newfile_name)) {
                            #Add data to uploads
                            $uap_model = new ApplicationsUploads();
                            $uap_model->institute_id = $institute_id;
                            $uap_model->loan_type_id = $loan_type_id;
                            $uap_model->file_name = $newfile_name;

                            $uap_model->save(FALSE);
                            $process = self::processAppsExcel($uap_model->id);
                            if ($process) {
                                #Send response
                                $response_data['msg'] = 'Upload Successful!!!';
                                $response_data['status'] = 'success';
                                $response_data['html'] = $process;
                                $response_data['id'] = $uap_model->id;
                                echo json_encode($response_data);
                            } else {
                                throw new \Exception("Something went wrong!!!");
                            }
                        } else {
                            throw new \Exception("Something went wrong!!!");
                        }
                    } else {
                        throw new \Exception($errors);
                    }
                } else {
                    throw new \Exception("Invalid Data!!");
                }
            } else {
                throw new \Exception("Something went wrong!!!");
            }
        } catch (\Exception $e) {
            $response_data['msg'] = $e->getMessage();
            $response_data['status'] = 'failure';
            echo json_encode($response_data);
        }
    }

    public function processAppsExcel($id) {
        try {
            #fetch filename
            $model = new Applications();
            $apps_data = ApplicationsUploads::find()->where(['id' => $id, 'is_deleted' => '0'])->one();

            if (!empty($apps_data)) {

                $data = \moonland\phpexcel\Excel::import(self::EXCEL_UPLOAD_DIR_NAME . '/' . $apps_data->file_name, [
                            'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
                            'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
                            'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
                ]);
                if (!empty($data)) {
                    foreach ($data as $key => $dataDtl) {
                        $data[$key]['Dedupe Check'] = "<button type='button' class='btn btn-block btn-primary btn-sm' onclick=" . "getForm('{$dataDtl['First Name']}','{$dataDtl['Middle Name']}','{$dataDtl['Last Name']}','{$dataDtl['Pan Card No']}','{$dataDtl['Mobile No']}','{$dataDtl['Aadhaar Card No']}')" . "> Dedupe Check</button><br>
                        <input type='text' name='profile_id[$key]' value='' id='profile_id_{$dataDtl['First Name']}_{$dataDtl['Middle Name']}_{$dataDtl['Last Name']}' rel='$key'/> ";
                    }
                }
//                print_r($data);
//                die;
                $provider = new \yii\data\ArrayDataProvider([
                    'allModels' => $data,
                    'sort' => [
                        'attributes' => ['Sr', 'First Name', 'Middle Name'],
                    ],
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                ]);

                return $this->renderPartial('upload_partial', [
                            'dataProvider' => $provider,
                            'model' => $model,
                ]);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionSubmitUExcel() {
        $response_data = array();
        try {
            if (!empty($_POST)) {

                $finalProfileIds = [];
                if (!empty($_POST['profile_id'])) {
                    $profileIds = $_POST['profile_id'];
                    $profileIds = explode(",", $profileIds);
                    foreach ($profileIds as $profileId) {
                        $singleProfile = explode("=", $profileId);
                        $finalProfileIds[$singleProfile[0]] = $singleProfile[1];
                    }
                }
                $data = $_POST;
                $id = $data['id'];
                #fetch filename
                $apps_data = ApplicationsUploads::find()->where(['id' => $id, 'is_deleted' => '0'])->one();

                if (!empty($apps_data)) {

                    $data = \moonland\phpexcel\Excel::import(self::EXCEL_UPLOAD_DIR_NAME . '/' . $apps_data->file_name, [
                                'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
                                'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
                                'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
                    ]);
                    if (!empty($data)) {
                        $r_data = self::saveExeclData($id, $data, $apps_data->institute_id, $apps_data->loan_type_id, $finalProfileIds);
                        $status = 'failure';
                        $msg = 'Something went wrong!!!';
                        if (!empty($r_data)) {
                            $status = $r_data['status'];
                            $msg = $r_data['msg'];
                        }
                        $response_data['msg'] = $msg;
                        $response_data['status'] = $status;
                        echo json_encode($response_data);
                    } else {
                        throw new \Exception("File Not Found!!!");
                    }
                } else {
                    throw new \Exception("File Not Found!!!");
                }
            } else {
                throw new \Exception("Something went wrong!!!");
            }
        } catch (\Exception $e) {
            $response_data['msg'] = $e->getMessage();
            $response_data['status'] = 'failure';
            echo json_encode($response_data);
        }
    }

    function saveExeclData($id, $data, $institute_id, $loan_type_id, $profileIds = []) {
        try {
            foreach ($data as $key1 => $exceldata) {
                $model = new Applications();
                $new_applicant_profile = new ApplicantProfile();
                foreach ($exceldata as $key => $value) {
                    if (array_key_exists($key, $this->excel_columns_applicant_profile)) {
                        $fkey = $this->excel_columns_applicant_profile[$key];
                        $new_applicant_profile->$fkey = $value;
                    }
                    if (array_key_exists($key, $this->excel_columns_applications)) {
                        if ($key == 'Applicant Type') {
                            $value = ($value == 'Salaried') ? 1 : 2;
                        }
                        if ($key == 'Profile Type') {
                            $value = ($value == 'Resi') ? 1 : (($value == 'Office') ? 2 : 3);
                        }
                        if ($key == 'Date Of Application') {
                            $value = date("Y-m-d", strtotime($value));
                        }
                        if ($key == 'Date Of Birth') {
                            $value = date("Y-m-d", strtotime($value));
                        }
                        $fkey = $this->excel_columns_applications[$key];
                        $model->$fkey = $value;
                    }
                }

                if (isset($profileIds[$key1]))
                    $model->profile_id = $profileIds[$key1];
                if (empty($model->profile_id)) {
                    $new_applicant_profile->save(FALSE);
                    $model->profile_id = $new_applicant_profile->id;
                }
                $model->institute_id = $institute_id;
                $model->loan_type_id = $loan_type_id;
                if ($model->save()) {
                    #Save Application id
                    $model->application_id = self::getApplicationId($model->id, $model->institute_id);
                    self::updateLatLong($model->id);
                    $model->save();
                    #Update status
                    $apps_data = ApplicationsUploads::find()->where(['id' => $id])->one();
                    $apps_data->status = 1;
                    $apps_data->save();
                } else {
                    $errors = self::processDbErrors($model->getErrors());
                    throw new \Exception($errors);
                }
            }
        } catch (\Exception $e) {
            $response_data['msg'] = $e->getMessage();
            $response_data['status'] = 'failure';
            return $response_data;
        }
        $response_data['msg'] = 'Successfully Added!!!';
        $response_data['status'] = 'success';
        return $response_data;
    }

    public function processDbErrors($data) {
        $return_data = '';
        if (!empty($data)) {
            foreach ($data as $error) {
                foreach ($error as $key => $value) {
                    $return_data .= 'Row ' . ($key + 1) . ' : ' . $value . '<br>';
                }
            }
        }
        return $return_data;
    }

    public function actionSampleTemplate() {
        $name = 'upload_applications.xlsx';
        $file_path = Yii::$app->basePath . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . self::SAMPLE_TEMPLATE_DIR_NAME . DIRECTORY_SEPARATOR . $name;

        if (file_exists($file_path)) {
            $len = filesize($file_path); // Calculate File Size
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"); // Send type of file
            $header = "Content-Disposition: attachment; filename=$name;"; // Send File Name
            header($header);
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . $len); // Send File Size
            @readfile($file_path);
            exit;
        } else {
            return $this->redirect(['index']);
        }
    }

    /**
     * Lists all Applications models.
     * @return mixed
     */
    public function actionUploadHistory() {
        $searchModel = new ApplicationsUploadsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('uploads_index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function updateLatLong($id) {
        $model = $this->findModel($id);
        //Lat long
        if ($model->resi_address_verification == 1) {
            $latlong = array();
            $latlong = Applications::getLatLong($model->resi_address_pincode, $model->resi_address);

            if (!empty($latlong)) {
                $model->resi_address_lat = $latlong['latitude'];
                $model->resi_address_long = $latlong['longitude'];
            }
        }
        if ($model->office_address_verification == 1) {
            $latlong = array();
            $latlong = Applications::getLatLong($model->office_address_pincode, $model->office_address);

            if (!empty($latlong)) {
                $model->office_address_lat = $latlong['latitude'];
                $model->office_address_long = $latlong['longitude'];
            }
        }
        if ($model->busi_address_verification == 1) {
            $latlong = array();
            $latlong = Applications::getLatLong($model->busi_address_pincode, $model->busi_address);

            if (!empty($latlong)) {
                $model->busi_address_lat = $latlong['latitude'];
                $model->busi_address_long = $latlong['longitude'];
            }
        }
        if ($model->noc_address_verification == 1) {
            $latlong = array();
            $latlong = Applications::getLatLong($model->noc_address_pincode, $model->noc_address);

            if (!empty($latlong)) {
                $model->noc_address_lat = $latlong['latitude'];
                $model->noc_address_long = $latlong['longitude'];
            }
        }
        if ($model->resi_office_address_verification == 1) {
            $latlong = array();
            $latlong = Applications::getLatLong($model->resi_office_address_pincode, $model->resi_office_address);

            if (!empty($latlong)) {
                $model->resi_office_address_lat = $latlong['latitude'];
                $model->resi_office_address_long = $latlong['longitude'];
            }
        }
        if ($model->builder_profile_address_verification == 1) {
            $latlong = array();
            $latlong = Applications::getLatLong($model->builder_profile_address_pincode, $model->builder_profile_address);

            if (!empty($latlong)) {
                $model->builder_profile_address_lat = $latlong['latitude'];
                $model->builder_profile_address_long = $latlong['longitude'];
            }
        }
        if ($model->property_apf_address_verification == 1) {
            $latlong = array();
            $latlong = Applications::getLatLong($model->property_apf_address_pincode, $model->property_apf_address);

            if (!empty($latlong)) {
                $model->property_apf_address_lat = $latlong['latitude'];
                $model->property_apf_address_long = $latlong['longitude'];
            }
        }
        if ($model->indiv_property_address_verification == 1) {
            $latlong = array();
            $latlong = Applications::getLatLong($model->indiv_property_address_pincode, $model->indiv_property_address);

            if (!empty($latlong)) {
                $model->indiv_property_address_lat = $latlong['latitude'];
                $model->indiv_property_address_long = $latlong['longitude'];
            }
        }
        if ($model->noc_soc_address_verification == 1) {
            $latlong = array();
            $latlong = Applications::getLatLong($model->noc_soc_address_pincode, $model->noc_soc_address);

            if (!empty($latlong)) {
                $model->noc_soc_address_lat = $latlong['latitude'];
                $model->noc_soc_address_long = $latlong['longitude'];
            }
        }

        $model->save();
    }

    public function actionDownloadExcel() {
        $objPHPExcel = new \PHPExcel();
        $sheet = 0;
        $arraydata = [];
        $objPHPExcel->setActiveSheetIndex($sheet);
        $header = ["First Name", "Last Name"];
        $arraydata[] = ['Prashant', 'Swami'];
        $arraydata[] = ['XXXXXXXX', 'ABC'];

        $objPHPExcel->setActiveSheetIndex(0);
        $row = 2;


        if (!empty($header)) {
            $cell_name = 'A';
            foreach ($header as $headerName) {
                $prev_cell_name = $cell_name;
                $objPHPExcel->getActiveSheet()->SetCellValue($cell_name . '1', $headerName);
                $cell_name++;
            }
            $objPHPExcel->getActiveSheet()->getStyle('A1:' . $prev_cell_name . '1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCCCC');
            $objPHPExcel->getActiveSheet()->getStyle('A1:' . $prev_cell_name . '1')->getFont()->setBold(true);
        }
        $rowNo = 1;
        foreach ($arraydata as $data) {
            $cell_name = 'A';
            $rowNo++;
            foreach ($data as $key => $value) {
                $objPHPExcel->getActiveSheet()->SetCellValue($cell_name . $rowNo, $value);
                $cell_name++;
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        $filename = "MyExcelReport_" . date("d-m-Y-His") . ".xls";
        header('Content-Disposition: attachment;filename=' . $filename . ' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function actionMapDetails() {
        $return_data = '';
        $data = $_POST;
        $id = $data['record_id'];
        $type = $data['section_id'];
        #get data
        $query = "SELECT * FROM view_all_sites WHERE app_id = $id and verification_type_id = $type";
        $table_data = \Yii::$app->getDb()->createCommand($query)->queryOne();
        if (!empty($table_data)) {
            $return_data = '{"latitude":"' . $table_data['latitude'] . '", "longitude":"' . $table_data['longitude'] . '"}';
        }
        return $return_data;
    }

    public function actionChangeApplicationStatus() {
        if (!empty($_POST)) {
            $app_id = $_POST['app_id'];
            $application_status = $_POST['application_status'];
            $verifiers_data = ApplicationsVerifiers::find()->where(['application_id' => $app_id, 'is_deleted' => '0'])->all();
            $string = '<form id="select_status"><div class="col-lg-12"><label class="control-label">Change Application Status</label>
                 <div class="panel-body"><div class="row"><select class="form-control" id="application_status" name="status">
                    <option value="">Select Status</option>
                ';
            if ($application_status == 1 AND empty($verifiers_data)) {
                $string .= '<option value="2">Inprogress</option>';
            }
            $string .= '<option value="3">Complete</option> </select>
                        <br/>';
            $string .= "<input type='hidden' value=$app_id name='app_id'>";
            $string .= '<button type="button" class="btn btn-danger select_application_status">Submit</button>
                         </div></div></div>
                         </form>';
            echo $string;
        }
    }

    public function actionSaveApplicationStatus() {
        if (!empty(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            $app_id = $_POST['app_id'];
            $status = $_POST['status'];
            $sql = "UPDATE tbl_applications set application_status=$status WHERE id=$app_id";
            Yii::$app->db->createCommand($sql)->execute();
            echo "Done";
        }
    }

    public function actionRevisitApplication() {
        if (!empty(Yii::$app->request->post())) {
            $app_id = $_POST['app_id'];
            $model = new Applications();
            $modelHistory = new ApplicationsHistory();
            $applicationData = $model->findOne(['id' => $app_id]);
            if (!empty($applicationData)) {
                foreach ($applicationData as $key => $value) {
                    if ($key == 'id') {
                        $modelHistory->previous_id = $value;
                    } else {
                        $modelHistory->$key = $value;
                    }
                }
            }
            $applicationData->application_status = 2;
            $applicationData->save(false);
            $modelHistory->save(false);
        }
        echo "Done";
    }

    public function actionCreateParagraph() {

        $sql = "show columns from tbl_applications";
        $columns = Yii::$app->db->createCommand($sql)->queryAll();
        $fields = array();
        foreach ($columns as $column) {
            $fields[] = $column['Field'];
        }
        $model = new ApplicationParagraph();

        if (!empty($_REQUEST)) {
            $model->attributes = $_REQUEST['ApplicationParagraph'];
            $model->type_of_verification = $_REQUEST['ApplicationParagraph']['type_of_verification'];
            $model->door_status = $_REQUEST['ApplicationParagraph']['door_status'];
            $model->created_at = date("Y-m-d H:i:s");
            $model->created_by = Yii::$app->user->id;
            $model->save();
            \Yii::$app->getSession()->setFlash('success', 'Record added Successfully.');
            return $this->redirect(['manage-paragraphs']);
        }
        return $this->render('create_para', ['fields' => $fields, 'model' => $model]);
    }

    public function actionManageParagraphs() {
        $model = new ApplicationParagraph();

        $dataProvider = $model->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 10];

        return $this->render('manage_paragraph', [
                    'searchModel' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPhotoMapDetails() {
        $return_data = '';
        $data = $_POST;
        $id = $data['record_id'];
        #get data
        $query = "SELECT * FROM tbl_applicant_photos WHERE id = $id";
        $table_data = \Yii::$app->getDb()->createCommand($query)->queryOne();
        if (!empty($table_data)) {
            $return_data = '{"latitude":"' . $table_data['latitude'] . '", "longitude":"' . $table_data['longitude'] . '"}';
        }
        return $return_data;
    }

    public function actionUpdateParagraph($id) {
        $model = new ApplicationParagraph();
        $model = ApplicationParagraph::findOne($id);
        $sql = "show columns from tbl_applications";
        $columns = Yii::$app->db->createCommand($sql)->queryAll();
        $fields = array();
        foreach ($columns as $column) {
            $fields[] = $column['Field'];
        }
        if (!empty($_REQUEST) && isset($_REQUEST['ApplicationParagraph'])) {
            $model->attributes = $_REQUEST['ApplicationParagraph'];
            $model->type_of_verification = $_REQUEST['ApplicationParagraph']['type_of_verification'];
            $model->door_status = $_REQUEST['ApplicationParagraph']['door_status'];
            $model->modified_at = date("Y-m-d H:i:s");
            $model->modified_by = Yii::$app->user->id;
            $model->save();
            \Yii::$app->getSession()->setFlash('success', 'Record updated Successfully.');
            return $this->redirect(['manage-paragraphs']);
        }

        return $this->render('create_para', [
                    'model' => $model,
                    'fields' => $fields,
        ]);
    }

    public function actionDeleteParagraph($id) {
        if (!empty($_REQUEST) AND isset($_REQUEST['id'])) {
            $updateFilePull = ApplicationParagraph::updateAll(['is_deleted' => 1, 'deleted_by' => Yii::$app->user->id], ['id' => $id]);
            \Yii::$app->getSession()->setFlash('success', 'Record deleted Successfully.');
            return $this->redirect(['manage-paragraphs']);
        }
    }

}
