<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */
/* @var $form yii\widgets\ActiveForm */
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
        <div class="col-lg-3"><?= $form->field($model, 'institute_id')->textInput() ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'loan_type_id')->textInput() ?></div>
    </div>

    <div class="row">
        <div class="col-lg-3"><?= $form->field($model, 'applicant_type')->textInput() ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'profile_type')->textInput() ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'area_id')->textInput() ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'date_of_application')->textInput() ?></div>
    </div>

<input type="hidden" name="step2" id="step2" value="1" />

    <div class="row">
        <div class="col-lg-12" style="text-align: right;">
            <?= Html::submitButton($model->isNewRecord ? 'Next' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
