<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="applications-form">

    <div class="div_search">
        <div class="row">
            <div class="col-lg-12">
                <form id="search_profile">
                    <div class="form-group col-sm-2">
                        <label for="inputFirstName">First Name</label>
                        <input type="text" class="form-control" id="inputFirstName" name="inputFirstName">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="inputMiddleName">Middle Name</label>
                        <input type="text" class="form-control" id="inputMiddleName" name="inputMiddleName">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="inputLastName">Last Name</label>
                        <input type="text" class="form-control" id="inputLastName" name="inputLastName">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="inputMobileNumber">Mobile Number</label>
                        <input type="text" class="form-control" id="inputMobileNumber" name="inputMobileNumber">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="inputPanCard">PAN Card</label>
                        <input type="text" class="form-control" id="inputPanCard" name="inputPanCard">
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="inputAadhaarCard">Aadhaar Card</label>
                        <input type="text" class="form-control" id="inputAadhaarCard" name="inputAadhaarCard">
                    </div>
                </form>
            </div>
            <div class="col-sm-12" style="position: relative;">
                <div class="form-group col-sm-2" style="float:right; text-align: right;">
                    <button type="button" id="search_profile_button" class="btn btn-primary">Search</button>
                </div>
            </div> 
        </div>
    </div>

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
        <div class="col-lg-3"><?= $form->field($model, 'institute_id')->dropDownList(ArrayHelper::map($institutes->find()->asArray()->all(), 'id', 'name'),['prompt'=>'Select Institute'])->label('Institute Name') ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'loan_type_id')->dropDownList(ArrayHelper::map($loantypes->find()->asArray()->all(), 'id', 'loan_name'),['prompt'=>'Select Loan Type'])->label('Loan Type') ?></div>
    </div>

    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'applicant_type')->dropDownList(['1' => 'Salaried', '2' => 'Self-employed'],['prompt'=>'Select Applicant Type']) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'profile_type')->dropDownList(['1' => 'Resi', '2' => 'Office', '3' => 'Resi/Office'],['prompt'=>'Select Profile Type']) ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'area_id')->dropDownList(ArrayHelper::map($area_model->find()->asArray()->all(), 'id', 'name'),['prompt'=>'Select Area'])->label('Area') ?></div>
        <div class="col-lg-3">
            <?php
                $model->date_of_application = date('Y-m-d');
            ?>
            <?= $form->field($model, 'date_of_application')->widget(
                DatePicker::className(), [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'endDate' => '0d',
                        'todayHighlight' => true
                    ]
            ]);?>
        </div>
    </div>
    <input type="hidden" name="step2" id="step2" value="1" />

    <div class="row">
        <div class="col-lg-12" style="text-align: right;">
            <?= Html::submitButton($model->isNewRecord ? 'Next' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'header' => '<h4><i class="text-white fa fa-binoculars"></i> Search Applicant Profiles</h4>',
    'id' => 'profile_modal',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent'><div style='text-align:center'><img src='../../images/acs_loader.gif'></div></div>";
yii\bootstrap\Modal::end();
?>

<?php
$this->registerJs("
        $(function(){   
            $('#search_profile_button').on('click', function() {
                var form_data = $('#search_profile').serialize();
                var url = '" . yii\helpers\Url::to(["manage-applications/get-applicant-profile"]) . "';
                $('#profile_modal').modal('show');
                $.post(url, form_data,function(response) {
                    $('#modalContent').html(response);
                });
            }); 
            
            $(document).on('click', '.btn_select_record', function(){ 
                var parameter = $(this).val();
                window.location = 'create?profile_id=' + parameter;
                alert('dsasa');
            });
        });
    ");
