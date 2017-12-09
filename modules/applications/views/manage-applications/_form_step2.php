<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */
/* @var $form yii\widgets\ActiveForm */
$institutes->id = $model->institute_id;
$loantypes->id = $model->loan_type_id;
$area_model->id = $model->area_id;
?>

<div class="applications-form">

    <!--    <div class="div_search">
            <div class="row">
                <div class="col-lg-12">sdfs</div>
            </div>
        </div>-->

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'profile_id')->textInput() ?>

    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'aadhaar_card_no')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'pan_card_no')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'institute_id')->dropDownList(ArrayHelper::map($institutes->find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Select Institute'])->label('Institute Name') ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'loan_type_id')->dropDownList(ArrayHelper::map($loantypes->find()->asArray()->all(), 'id', 'loan_name'), ['prompt' => 'Select Loan Type'])->label('Loan Type') ?></div>
    </div>

    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'applicant_type')->dropDownList(['1' => 'Salaried', '2' => 'Self-employed'], ['prompt' => 'Select Applicant Type']) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'profile_type')->dropDownList(['1' => 'Resi', '2' => 'Office', '3' => 'Resi/Office'], ['prompt' => 'Select Profile Type']) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'area_id')->dropDownList(ArrayHelper::map($area_model->find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Select Area'])->label('Area') ?></div>
        <div class="col-lg-3">
            <?=
            $form->field($model, 'date_of_application')->widget(
                    DatePicker::className(), [
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'endDate' => '0d',
                    'todayHighlight' => true
                ]
            ]);
            ?>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <strong>Residence Address</strong>
                    </h4>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'resi_address')->textArea()->label(false) ?>
                    <?= $form->field($model, 'resi_address_verification')->checkboxList(['1' => 'Send for verification'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <strong>Office Address</strong>
                    </h4>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'office_address')->textArea()->label(false) ?>
                    <?= $form->field($model, 'office_address_verification')->checkboxList(['1' => 'Send for verification'])->label(false); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <strong>Business Address</strong>
                    </h4>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'busi_address')->textArea()->label(false) ?>
                    <?= $form->field($model, 'busi_address_verification')->checkboxList(['1' => 'Send for verification'])->label(false); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-group" id="accordion" style="margin-bottom: 20px;">
        <!--Residence Verification-->
        <div class="panel panel-default cust-panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#resi_verification"><strong>Residence Verification</strong></a>
                </h4>
            </div>
            <div id="resi_verification" class="panel-collapse collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'resi_society_name_plate')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'resi_door_name_plate')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'resi_tpc_neighbor_1')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'resi_tpc_neighbor_2')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'resi_met_person')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'resi_relation')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'resi_home_area')->textInput() ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'resi_owner_ship_status')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'resi_stay_years')->textInput() ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'resi_total_family_members')->textInput() ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'resi_working_members')->textInput() ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'resi_locality')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'resi_landmark_1')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'resi_landmark_2')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3"></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12"><?= $form->field($model, 'resi_remarks')->textInput(['maxlength' => true]) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!--Business Verification-->
        <div class="panel panel-default cust-panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#busi_verification"><strong>Business Verification</strong></a>
                </h4>
            </div>
            <div id="busi_verification" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'busi_tpc_neighbor_1')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'busi_tpc_neighbor_2')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'busi_company_name_board')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'busi_met_person')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'busi_designation')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'busi_nature_of_business')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'busi_staff')->textInput() ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'busi_years_in_business')->textInput() ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'busi_type_of_business')->dropDownList(['1' => 'DIRECTORSHIP', '2' => 'PROPRIETOR', '3' => 'PARTNERSHIP'], ['prompt' => 'Select Type Of Business']) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'busi_ownership_status')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'busi_area')->textInput() ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'busi_locality')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'busi_landmark_1')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'busi_landmark_2')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3"></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12"><?= $form->field($model, 'busi_remarks')->textInput(['maxlength' => true]) ?></div>
                    </div>    
                </div>
            </div>
        </div>    

        <!--Office Verification-->
        <div class="panel panel-default cust-panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#office_verification"><strong>Office Verification</strong></a>
                </h4>
            </div>
            <div id="office_verification" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'office_met_person')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'office_designation')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'office_nature_of_company')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'office_employment_years')->textInput() ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'office_net_salary_amount')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'office_tpc_for_applicant')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'office_tpc_for_company')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'office_landmark')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12"><?= $form->field($model, 'office_remarks')->textInput(['maxlength' => true]) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!--ITR-->
        <div class="panel panel-default cust-panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#itr"><strong>ITR</strong></a>
                </h4>
            </div>
            <div id="itr" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php echo $itrTable; ?>
                </div>
            </div>
        </div>

        <!--Financial-->
        <div class="panel panel-default cust-panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#financial"><strong>Financial</strong></a>
                </h4>
            </div>
            <div id="financial" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'financial_pan_card_no')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'financial_name')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3">
                            <?php
                            echo '<label class="control-label">Assessment Year</label>';
                            echo DatePicker::widget([
                                'name' => 'Applications[financial_assessment_year]',
                                'type' => DatePicker::TYPE_INPUT,
                                'value' => $model->date_of_application,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-3">
                            <?php
                            echo '<label class="control-label">Date Of Filing</label>';
                            echo DatePicker::widget([
                                'name' => 'Applications[financial_date_of_filing]',
                                'type' => DatePicker::TYPE_INPUT,
                                'value' => $model->date_of_application,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]);
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'financial_sales')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'financial_share_capital')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'financial_net_profit')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'financial_debtors')->textInput(['maxlength' => true]) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'financial_creditors')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'financial_total_loans')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'financial_depriciation')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--Bank Statement-->
        <div class="panel panel-default cust-panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#bank_statement"><strong>Bank Statement</strong></a>
                </h4>
            </div>
            <div id="bank_statement" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'bank_bank_name')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'bank_account_holder')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'bank_account_number')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'bank_dated_transaction')->textInput() ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3"><?= $form->field($model, 'bank_pan_card_no')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3"><?= $form->field($model, 'bank_current_balance')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-3">
                            <?php
                            echo '<label class="control-label">Account Opening Date</label>';
                            echo DatePicker::widget([
                                'name' => 'Applications[bank_account_opening_date]',
                                'type' => DatePicker::TYPE_INPUT,
                                'value' => $model->date_of_application,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]);
                            ?>
                        </div>
                        <div class="col-lg-3">
                            <?php
                            echo '<label class="control-label">Date Of Birth</label>';
                            echo DatePicker::widget([
                                'name' => 'Applications[bank_date_of_birth]',
                                'type' => DatePicker::TYPE_INPUT,
                                'value' => $model->date_of_application,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]);
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6"><?= $form->field($model, 'bank_address')->textInput(['maxlength' => true]) ?></div>
                        <div class="col-lg-6"><?= $form->field($model, 'bank_narration')->textInput(['maxlength' => true]) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!--NOC-->
        <div class="panel panel-default cust-panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#noc"><strong>NOC</strong></a>
                </h4>
            </div>
            <div id="noc" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php echo $nocTable; ?>
                </div>
            </div>
        </div>

        <!--KYC-->
        <div class="panel panel-default cust-panel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#kyc"><strong>KYC</strong></a>
                </h4>
            </div>
            <div id="kyc" class="panel-collapse collapse">
                <div class="panel-body" id="kyc_table">
                    <?php echo $kycTable; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= Html::submitButton(($model->isNewRecord || $step2 == 1) ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!--Custom query modal-->    
<div class="modal fade" id="modal-kyc-upload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header label-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="text-white fa fa-pencil-square-o"></i> <span
                        class="text-white bold">Upload KYC</span></h4>
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
                    <input type="hidden" name="application_id" id="application_id" value="<?= $model->id; ?>" />
                    <input type="hidden" name="application_number" id="application_number" value="<?= $model->application_id; ?>" />

                </div>

                <div class="modal-footer" id="kyc_modal_footer">
                    <div id="button_div">
                        <button type="submit" class="btn btn-primary" id="kyc_submit">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>
                            Close
                        </button>
                    </div>
                    <div id="loader_div" style="display: none;">
                        Uploading.... <img src='../../images/acs_loader.gif'>
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
            $('#addMoreItr').on('click', function() {
                var data = $('#itr_table tr:eq(1)').clone(true).appendTo('#itr_table');
                data.find('input').val('');
            });
            $('#addMoreNoc').on('click', function() {
                var data = $('#noc_table tr:eq(1)').clone(true).appendTo('#noc_table');
                data.find('input').val('');
            });
            $('#addMoreKyc').on('click', function() {
                // Call Modal
                $('#modal-kyc-upload').modal('show'); 
            });
            $(document).on('click', '.remove', function() {
                var trIndex = $(this).closest('tr').index();
                    if(trIndex>1) {
                    $(this).closest('tr').remove();
                } else {
                    alert('Sorry!! Can\'t remove first row!');
                }
            });
            
            $(document).on('click', '.deleteKyc', function() {
                kyc_id = this.value; 
                alert(kyc_id);
            });

            $('#kyc_form').on('submit',(function(e) {
                $('#button_div').hide();
                $('#loader_div').show();
                e.preventDefault();
                $.ajax({
                    url: 'upload-kyc', // Url to which the request is send
                    type: 'POST',             // Type of request to be send, called as method
                    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(data)   // A function to be called if request succeeds
                    {
                        $('#loader_div').hide();
                        $('#response_div').show();
                        $('#response_div').html(data);
                        
                        //hide & reset modal 
                        setTimeout(function() { 
                            resetModal();
                        }, 3000);
                        
                    }
                });
            }));
            
            function resetModal() {
                $('#modal-kyc-upload').modal('hide'); 
                $('#button_div').show(); 
                $('#response_div').hide();
                $('#kyc_form').reset;
                
                //reload KYC table
                $.post('get-kyc-table?id=$model->id&isAjaxCall=1', {'data': ''}, function (response) {
                    $('#kyc_table').html(response);
                });
            }
        });    
    ");