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

/**
 * ManageApplicationsController implements the CRUD actions for Applications model.
 */
class ManageApplicationsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
    public function actionIndex()
    {
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Applications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Applications();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $step2 = isset($_REQUEST['step2']) ? $_REQUEST['step2'] : 0;
            return $this->redirect(['update', 'id' => $model->id, 'step2' => $step2]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Applications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $institutes = new Institutes();
        $loantypes = new LoanTypes();
        $area_model = new Area();
        $itrTable = $this->getItrTable($id);
        $nocTable = $this->getNocTable($id);
        $kycTable = $this->getKycTable($id);
        
        $step2 = isset($_REQUEST['step2']) ? $_REQUEST['step2'] : 0;
        
        if(Yii::$app->request->post()) {
            if(isset($_POST['Institutes']['id'])) {
                $model->institute_id = $_POST['Institutes']['id'];
            }
            if(isset($_POST['LoanTypes']['id'])) {
                $model->loan_type_id = $_POST['LoanTypes']['id'];
            }
            if(isset($_POST['Area']['id'])) {
                $model->area_id = $_POST['Area']['id'];
            }
            #ITR
            if(isset($_POST['itr']) && !empty($_POST['itr'])) {
                //$this->processItr($_POST['itr'], $model->id);
            }            
            #NOC
            if(isset($_POST['noc']) && !empty($_POST['noc'])) {
                $this->processNoc($_POST['noc'], $model->id);
            }
            if($model->load(Yii::$app->request->post()) && $model->save()) {
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
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
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
                            <th>Date of Filing (YYYY-MM-DD)</th>
                            <th>Pan no.</th>
                            <th>Acknowledgement No. (YYYY-YYYY)</th>
                            <th>Assesement year</th>
                            <th><a href="javascript:void(0);" style="font-size:18px;" id="addMoreItr" title="Add More ITR"><span class="glyphicon glyphicon-plus"></span></a></th>';
        $return_html .= '</tr>';
        if (!empty($itrs)) {
            foreach ($itrs as $itr_data) {
                $return_html .= '<tr>';
                $return_html .= '<td><input type="text" name="itr[total_income][]" value="'.$itr_data['total_income'].'" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="itr[date_of_filing][]" value="'.$itr_data['date_of_filing'].'" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="itr[pan_card_no][]" value="'.$itr_data['pan_card_no'].'" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="itr[acknowledgement_no][]" value="'.$itr_data['acknowledgement_no'].'" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="itr[assessment_year][]" value="'.$itr_data['assessment_year'].'" class="form-control"></td>';
                $return_html .= '<td><a href="javascript:void(0);"  class="remove"><span class="glyphicon glyphicon-trash"></span></a></td>';
                $return_html .= '</tr>';
            }
        } else {
            $return_html .= '<tr>';
            $return_html .= '<td><input type="text" name="itr[total_income][]" class="form-control"></td>';
            $return_html .= '<td><input type="text" name="itr[date_of_filing][]" class="form-control"></td>';
            $return_html .= '<td><input type="text" name="itr[pan_card_no][]" class="form-control"></td>';
            $return_html .= '<td><input type="text" name="itr[acknowledgement_no][]" class="form-control"></td>';
            $return_html .= '<td><input type="text" name="itr[assessment_year][]" class="form-control"></td>';
            $return_html .= '<td><a href="javascript:void(0);"  class="remove"><span class="glyphicon glyphicon-trash"></span></a></td>';
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
                $return_html .= '<td><input type="text" name="noc[met_person][]" value="'.$noc_data['met_person'].'" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="noc[designation][]" value="'.$noc_data['designation'].'" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="noc[remarks][]" value="'.$noc_data['remarks'].'" class="form-control"></td>';
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
    
    public function getKycTable($id) {
        
        $nocs = Kyc::find()->where(['application_id' => $id, 'is_deleted' => '0'])->all();
        
        $return_html = '<table  class="table table-hover small-text" id="kyc_table">
                        <tr class="tr-header">
                            <th>Doc type</th>
                            <th>Remarks</th>
                            <th>Download Link</th>
                            <th><a href="javascript:void(0);" style="font-size:18px;" id="addMoreKyc" title="Add More KYC"><span class="glyphicon glyphicon-plus"></span></a></th>';
        $return_html .= '</tr>';
        if (!empty($nocs)) {
            foreach ($nocs as $noc_data) {
                $return_html .= '<tr>';
                $return_html .= '<td><input type="text" name="kyc[doc_type][]" value="'.$noc_data['doc_type'].'" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="kyc[remarks][]" value="'.$noc_data['remarks'].'" class="form-control"></td>';
                $return_html .= '<td><input type="text" name="kyc[file_name][]" value="'.$noc_data['file_name'].'" class="form-control"></td>';
                $return_html .= '<td><a href="javascript:void(0);"  class="remove"><span class="glyphicon glyphicon-trash"></span></a></td>';
                $return_html .= '</tr>';
            }
        } else {
            $return_html .= '<tr>';
            $return_html .= '<td><input type="text" name="kyc[doc_type][]" class="form-control"></td>';
            $return_html .= '<td><input type="text" name="kyc[remarks][]" class="form-control"></td>';
            $return_html .= '<td><input type="text" name="kyc[file_name][]" class="form-control"></td>';
            $return_html .= '<td><a href="javascript:void(0);"  class="remove"><span class="glyphicon glyphicon-trash"></span></a></td>';
            $return_html .= '</tr>';
        }    
        
        $return_html .= '</table>';
        
        return $return_html;
    }
    
    public function processItr($itr_data, $id) {
        Itr::deleteAll('application_id = :application_id', [':application_id' => $id]);
        $for_count = count($itr_data['total_income']);
        
        if($for_count == 1) {
            if(empty($itr_data['total_income'][0]) && empty($itr_data['date_of_filing'][0]) && empty($itr_data['pan_card_no'][0]) && empty($itr_data['acknowledgement_no'][0]) && empty($itr_data['assessment_year'][0])) {
                return true;
            }
        }
        
        for($i = 0; $i < $for_count ; $i++) {
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
        
        if($for_count == 1) {
            if(empty($noc_data['met_person'][0]) && empty($noc_data['designation'][0]) && empty($noc_data['remarks'][0])) {
                return true;
            }
        }
        
        for($i = 0; $i < $for_count ; $i++) {
            $model = new Noc();
            
            $model->application_id = $id;
            $model->met_person = isset($noc_data['met_person'][$i]) ? $noc_data['met_person'][$i] : '';
            $model->designation = isset($noc_data['designation'][$i]) ? $noc_data['designation'][$i] : '';
            $model->remarks = isset($noc_data['remarks'][$i]) ? $noc_data['remarks'][$i] : '';
            $model->save();
        }
    }
}
