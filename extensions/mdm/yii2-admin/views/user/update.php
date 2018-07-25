<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Update User:' . " " . "$model->username";
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$controllerId = $this->context->uniqueId . '/';
$this->registerJsFile(
        Yii::$app->request->BaseUrl . '/js/jquery.tokeninput.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerCssFile(Yii::$app->request->BaseUrl . "/css/token-input-facebook.css");
?>
<section class="panel">
    <div class="panel-body">
        <?= Html::errorSummary($model) ?>
        <?php $form = ActiveForm::begin(['id' => 'form-update']); ?>
        
        <div class="row">
                <div class="col-lg-12">
                    <h3>Personal Deails</h3><hr />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3"><?= $form->field($userDetails, 'first_name') ?></div>
                <div class="col-lg-3"><?= $form->field($userDetails, 'middle_name') ?></div>
                <div class="col-lg-3"><?= $form->field($userDetails, 'last_name') ?></div>
                <div class="col-lg-3"><?= $form->field($userDetails, 'designation') ?></div>
            </div>
            <div class="row">
                <div class="col-lg-3"><?= $form->field($userDetails, 'mobile')->input('text', ['placeholder' => '+ followed by max 12 digits', 'maxlength' => 13]) ?></div>
                <div class="col-lg-3"><?= $form->field($userDetails, 'phone')->input('text', ['placeholder' => '+ followed by max 12 digits', 'maxlength' => 13]) ?></div>
                <div class="col-lg-3"><?= $form->field($userDetails, 'city') ?></div>
                <div class="col-lg-3"><?= $form->field($userDetails, 'state') ?></div>
            </div>
            <div class="row">
                <div class="col-lg-3"><?= $form->field($userDetails, 'country')->dropDownList(Yii::$app->commonUtility->getCountryDropdown(), ['prompt' => '(Select Country)']) ?></div>
                <div class="col-lg-3"><?= $form->field($userDetails, 'pin')->input('text', ['maxlength' => 6]) ?></div>
                <div class="col-lg-4"><?= $form->field($userDetails, 'address')->textArea() ?></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3>Account Details</h3><hr />
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3"><?= $form->field($model, 'username')->input('text', ['readonly' => true]) ?></div>
                <div class="col-lg-3"><?= $form->field($model, 'email')->input('text', ['readonly' => true]) ?></div>                
                <div class="col-lg-3"><?= $form->field($model, 'status')->dropDownList($statusData, ['prompt' => 'Select Status'])->label('Select Status') ?></div>
                <div class="col-lg-3"><?= $form->field($userDetails, 'role_id')->dropDownList($roles, ['prompt' => 'Select Role'])->label('Role') ?></div>
            </div>
            
            <div class="row">            
                <div class="col-lg-3"><?= $form->field($userDetails, 'institute_id')->textInput(["id" => "tokeninput"]); ?></div>
                <div class="col-lg-3"><?= $form->field($userDetails, 'loan_id')->textInput(["id" => "tokeninput_loan"]); ?></div>
            </div>
            
            <div class="row">
                <div class="col-lg-12" style="text-align: right;">
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat']) ?>
                    </div>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>


<?php
$this->registerJs("$(function(){
        $('#tokeninput').tokenInput($instituteData, {
            theme: 'facebook',
            prePopulate: $prePopulateInistitutes
        });
        $('#tokeninput_loan').tokenInput($loanData, { 
            theme: 'facebook',
            prePopulate: $prePopulateLoan
        });
});");
?>