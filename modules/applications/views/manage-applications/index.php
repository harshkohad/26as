<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\ApplicationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Applications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applications-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Applications', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="body-wrapper">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'application_id',
//            'first_name',
//            'middle_name',
//            'last_name',
            [
                'label' => 'Applicant Name',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getApplicantName($model->first_name, $model->middle_name, $model->last_name);
                }
            ],
            // 'aadhaar_card_no',
            // 'pan_card_no',
            // 'mobile_no',
            // 'institute_id',
            // 'loan_type_id',
            [
                'label' => 'Loan Type',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getLoanType($model->loan_type_id);
                }
            ],        
            // 'applicant_type',
            [
                'label' => 'Applicant Type',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getApplicantType($model->applicant_type);
                }
            ], 
            // 'profile_type',
            // 'area_id',
            'date_of_application',
            // 'resi_society_name_plate',
            // 'resi_door_name_plate',
            // 'resi_tpc_neighbor_1',
            // 'resi_tpc_neighbor_2',
            // 'resi_met_person',
            // 'resi_relation',
            // 'resi_home_area',
            // 'resi_owner_ship_status',
            // 'resi_stay_years',
            // 'resi_total_family_members',
            // 'resi_working_members',
            // 'resi_locality',
            // 'resi_landmark_1',
            // 'resi_landmark_2',
            // 'resi_remarks',
            // 'busi_tpc_neighbor_1',
            // 'busi_tpc_neighbor_2',
            // 'busi_company_name_board',
            // 'busi_met_person',
            // 'busi_designation',
            // 'busi_nature_of_business',
            // 'busi_staff',
            // 'busi_years_in_business',
            // 'busi_type_of_business',
            // 'busi_ownership_status',
            // 'busi_area',
            // 'busi_locality',
            // 'busi_landmark_1',
            // 'busi_landmark_2',
            // 'busi_remarks',
            // 'office_met_person',
            // 'office_designation',
            // 'office_nature_of_company',
            // 'office_employment_years',
            // 'office_net_salary_amount',
            // 'office_tpc_for_applicant',
            // 'office_tpc_for_company',
            // 'office_landmark',
            // 'office_remarks',
            // 'financial_pan_card_no',
            // 'financial_name',
            // 'financial_assessment_year',
            // 'financial_date_of_filing',
            // 'financial_sales',
            // 'financial_share_capital',
            // 'financial_net_profit',
            // 'financial_debtors',
            // 'financial_creditors',
            // 'financial_total_loans',
            // 'financial_depriciation',
            // 'bank_bank_name',
            // 'bank_account_holder',
            // 'bank_account_number',
            // 'bank_dated_transaction',
            // 'bank_pan_card_no',
            // 'bank_current_balance',
            // 'bank_account_opening_date',
            // 'bank_date_of_birth',
            // 'bank_address',
            // 'bank_narration',
            // 'application_status',
            // 'mobile_user_id',
            // 'mobile_user_assigned_date',
            // 'mobile_user_status',
            // 'mobile_user_status_updated_on',
            // 'created_by',
            // 'created_on',
            // 'update_by',
            // 'updated_on',
            // 'is_deleted',
            [
                'label' => 'Application Status',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getApplicationStatus($model->application_status);
                }
            ],
            [
                'label' => 'Verifier Status',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getVerifierStatus($model->id, $model->mobile_user_status);
                }
            ],        

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>

<!--Assign Verifier modal-->    
<div class="modal fade" id="modal-assign-verifier">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header label-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="text-white fa fa-pencil-square-o"></i> <span
                        class="text-white bold">Assign Verifier</span></h4>
            </div>
            <form id="kyc_form" method="post" enctype="multipart/form-data">
                <div class="modal-body" id="kyc_modal_body">

                    <div class="form-group">
                        <label for="doc_type" class="col-form-label">Doc Type:</label>
                        <input type="text" class="form-control" name="doc_type" id="doc_type">
                    </div>
                    <div class="form-group">
                        <label for="kyc_remarks" class="col-form-label">Remarks:</label>
                        <textarea class="form-control"  name="kyc_remarks" id="kyc_remarks"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input class="form-control" name="kyc_file" type="file">
                    </div>
                    
                </div>

                <div class="modal-footer" id="kyc_modal_footer">
                    <div id="button_div">
                        <button type="submit" class="btn btn-primary" id="kyc_submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                            Close
                        </button>
                    </div>
                    <div id="loader_div" style="display: none;">
                        Uploading.... <img src='<?php echo Yii::$app->request->BaseUrl; ?>/images/acs_loader.gif'>
                    </div>
                    <div id="response_div" style="display: none;">

                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php
$this->registerJs("
        $(function(){   
            $(document).on('click', '.assignVerifier', function() {
                var app_id = this.value;
                var data = {app_id: app_id,};
                $.post('get-verifier', data, function (response) {
                    //reloadKycTable();
                    $('#modal-assign-verifier').modal('show'); 
                });
                
            });
        });    
    ");