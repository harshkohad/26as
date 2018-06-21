<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\ApplicationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Applications';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
        <p>
            <?= Html::a('Create Applications', ['create'], ['class' => 'btn btn-success']) ?> 
            <?= Html::a('Upload Applications', ['upload-applications'], ['class' => 'btn btn-warning']) ?>
        </p> 
        <div>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
//            'id',
                    'application_id',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'case_id',
//                [
//                    'attribute' => 'first_name',
//                    //'label' => 'Applicant Name',
//                    'format' => 'raw',
//                    'value' => function ($model) {
//                        return $model->getApplicantName($model->first_name, $model->middle_name, $model->last_name);
//                    }
//                ],
                    // 'aadhaar_card_no',
                    // 'pan_card_no',
                    // 'mobile_no',
//                 'institute_id',
//                 'loan_type_id',
                    [
                        'attribute' => 'institute_id',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getInstituteNameType($model->institute_id);
                        }
                    ],
                    [
                        'attribute' => 'loan_type_id',
                        //'label' => 'Loan Type',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getLoanType($model->loan_type_id);
                        }
                    ],
                    // 'applicant_type',
                    [
                        'attribute' => 'applicant_type',
                        'label' => 'Applicant Type',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getApplicantType($model->applicant_type);
                        },
                        'filter' => ['1' => 'Salaried', '0' => 'Self-employed'],
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
                    // 'updated_by',
                    // 'updated_on',
                    // 'is_deleted',
                    [
                        'attribute' => 'application_status',
//                'label' => 'Application Status',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getApplicationStatus($model->id, $model->application_status);
                        },
                        'filter' => ['1' => 'New', '2' => 'Inprogress', '3' => 'Completed'],
                    ],
                    [
                        'label' => 'Verifier Status',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getVerifierStatus($model->id, $model->application_status);
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</section>

<!--Manage Verifier modal-->    
<div class="modal fade" id="modal-manage-verifier">
    <div class="modal-dialog" style="width: 1000px !important;">
        <div class="modal-content">
            <div class="modal-header label-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="text-white fa fa-pencil-square-o"></i> <span
                        class="text-white bold"><span id="model_title">Manage</span> Verifier</span></h4>
            </div>
            <div class="modal-body" id="verifier_modal_body" style="height:450px; overflow:auto;">


            </div>

            <div class="modal-footer" id="verifier_modal_footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                    Close
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="change_application_status">
    <div class="modal-dialog" style="width: 1000px !important;">
        <div class="modal-content">
            <div class="modal-header label-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="text-white fa fa-pencil-square-o"></i> <span
                        class="text-white bold">Change application status</span></h4>
            </div>
            <div class="modal-body" id="complete_application_modal_footer" style="height:450px; overflow:auto;">


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                    Close
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="floatingResponse alert" style="display: none;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <div id="responsemsg"> </div>
</div>

<?php
$loader_img = '<div style="text-align:center"><img src="' . Yii::$app->request->BaseUrl . '/images/acs_loader.gif"></div>';
$this->registerJs("
        $(function(){ 
            window.loader_img = '" . $loader_img . "';
            $(document).on('click', '.manageVerifier', function() {
                var app_id = this.value;
                var data = {app_id: app_id, is_manage: 1};
                $.post('get-verifier', data, function (response) {
                    $('#model_title').html('Manage');
                    $('#modal-manage-verifier').modal('show'); 
                    $('#verifier_modal_body').html(response);
                });
                
            });
            
            $(document).on('click', '.viewVerifier', function() {
                var app_id = this.value;
                var data = {app_id: app_id, is_manage: 0};
                $.post('get-verifier', data, function (response) {
                    $('#model_title').html('View');
                    $('#modal-manage-verifier').modal('show'); 
                    $('#verifier_modal_body').html(response);
                });
                
            });
            
            $(document).on('click', '.update_app_verifier', function() {
                var value = this.value;
                value_array = value.split('_');
                apptype = value_array[1];
                veriid = value_array[0];
                
                div_id = '#type_'+apptype;
                veri_id = '#verifier_'+apptype;
                
                selected_verifier = $(veri_id).val();
                
                $(div_id).html(window.loader_img);
                
                var data = {veriid: veriid, m_user_id : selected_verifier, verification_type : apptype};
                $.post('update-verifier', data, function (response) {
                    floatingResponse(response);
                    var obj = JSON.parse(response);
                    $(div_id).html(obj.html);
                });
            });
            
            $(document).on('click', '.delete_app_verifier', function() {
                var value = this.value;
                value_array = value.split('_');
                apptype = value_array[1];
                veriid = value_array[0];
                app_id = value_array[2];
                
                div_id = '#type_'+apptype;
                
                $(div_id).html(window.loader_img);
                
                var data = {veriid: veriid, verification_type : apptype, app_id : app_id};
                $.post('delete-verifier', data, function (response) {
                    floatingResponse(response);
                    var obj = JSON.parse(response);
                    $(div_id).html(obj.html);
                });
            });
            
            $(document).on('click', '.add_app_verifier', function() {
                var value = this.value;
                value_array = value.split('_');
                apptype = value_array[1];
                app_id = value_array[0];
                
                div_id = '#type_'+apptype;
                veri_id = '#verifier_'+apptype;
                
                selected_verifier = $(veri_id).val();
                
                $(div_id).html(window.loader_img);
                
                var data = {app_id: app_id, m_user_id : selected_verifier, verification_type : apptype};
                $.post('add-verifier', data, function (response) {
                    floatingResponse(response);
                    var obj = JSON.parse(response);
                    $(div_id).html(obj.html);
                });
                
            });
            
            function floatingResponse(response){
                var obj = JSON.parse(response);
                $('#responsemsg').html(obj.msg);
                if(obj.status == 'success') {
                    $('.floatingResponse').addClass('alert-success');
                } else {
                    $('.floatingResponse').addClass('alert-error');
                }
                $('.floatingResponse').show();
                    setTimeout(function(){
                        $('.floatingResponse').hide(); 
                    }, 3000);
            }
            $(document).on('click', '.change_application_status', function() {
                var app_id = this.value;
                var application_status = $(this).attr('rel');
                var data = {app_id: app_id,application_status:application_status};
                $.post('change-application-status', data, function (response) {
                    $('#change_application_status').modal('show'); 
                    $('#complete_application_modal_footer').html(response);
                });
                
            });
            $(document).on('click', '.select_application_status', function() {
                var form_data = $('#select_status').serialize();
                var url = '" . yii\helpers\Url::to(["manage-applications/save-application-status"]) . "';
                $.post(url, form_data,function(response) {
                    window.location.reload();
                });
            });
            $(document).on('click', '.revisit_application', function() {
            var app_id = this.value;
            var data = {app_id: app_id};
            bootbox.confirm('Are you sure youn want to revisit application?', function(result){
                $.post('revisit-application', data, function (response) {
                    window.location.reload();
                });
                
               });
                
            });
        });    
    ");
