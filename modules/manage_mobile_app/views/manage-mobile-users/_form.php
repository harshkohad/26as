<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\manage_mobile_app\models\TblMobileUsers */
/* @var $form yii\widgets\ActiveForm */
?>
<section class="panel">
    <div class="panel-body">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-lg-3"><?php
                if ($type == "create") {
                    echo $form->field($model, 'user_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($userData, "id", "username"),
                        'options' => ['placeholder' => 'Select Agent'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label("Field Agent Name");
                } else {
                    echo $form->field($model, 'field_agent_name')->textInput(['maxlength' => true, 'readOnly' => true]);
                }
                ?>
            </div>
            <div class="col-lg-3"><?= $form->field($model, 'mobile_unique_code')->textInput(['maxlength' => true]) ?></div>

            <div class="col-lg-3"><?= $form->field($model, 'mobile_imei_number')->textInput(['maxlength' => true]) ?></div>
            
            <div class="col-lg-3"></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
</section>
