<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\manage_mobile_app\models\TblMobileUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-mobile-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mobile_unique_code')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'field_agent_name')->textInput(['maxlength' => true]) ?>
    <?php
    
    if($type == "create") {
        echo $form->field($model, 'user_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($userData, "id", "username"),
            'options' => ['placeholder' => 'Select Agent'],
            'pluginOptions' => [
                'allowClear' => true
            ],
    ])->label("Field Agent Name"); 
    } else {
        echo $form->field($model, 'field_agent_name')->textInput(['maxlength' => true, 'readOnly'=> true]);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
