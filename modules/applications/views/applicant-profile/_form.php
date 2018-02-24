<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\ApplicantProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-applicant-profile-form">
    <div class="box-body">
        <div class="">
            <?php $form = ActiveForm::begin(); ?>

            <?php //$form->field($model, 'id')->textInput(['maxlength' => true]) ?>
            <div class="col-sm-4">
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">    
                <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">    
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-4">
                <?= $form->field($model, 'pan_card_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">    
                <?= $form->field($model, 'aadhaar_card_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">    
                <?= $form->field($model, 'passport_number')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="clearfix"></div>   
            <div class="col-sm-4">
                <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">                    
                <?= $form->field($model, 'itr_ack_number')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">    
                <?= $form->field($model, 'bank_statement_type')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-4">    
                <?= $form->field($model, 'bank_account_number')->textInput(['maxlength' => true]) ?>
            </div>               
            <div class="col-sm-8">                        
                <?php //$form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'address')->textarea(array('rows'=>2,'cols'=>5)); ?>
            </div>
                        
            
            <?PHP //$form->field($model, 'created_on')->textInput() ?>
            <div class="clearfix"></div>     
            <?PHP //$form->field($model, 'update_on')->textInput() ?>

            <?PHP //$form->field($model, 'is_deleted')->textInput() ?>

            <div class="col-sm-12">
                <div class="form-group text-center">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>   
    </div>

</div>
