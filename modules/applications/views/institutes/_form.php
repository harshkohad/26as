<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Institutes */
/* @var $form yii\widgets\ActiveForm */
?>


<section class="panel">
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-3"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="text-align: right;">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>
<!--<div class="institutes-form">-->

    

    

    <?php //$form->field($model, 'download_pdf')->textInput(); ?>

    <?php //$form->field($model, 'download_excel')->textInput() ?>

    <?php //$form->field($model, 'char_count')->textInput() ?>

    <?php //$form->field($model, 'is_alphanumeric')->textInput() ?>

    <?php //$form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'is_active')->textInput() ?>

    <?php //$form->field($model, 'created_by')->textInput() ?>

    <?php //$form->field($model, 'created_on')->textInput() ?>

    <?php //$form->field($model, 'updated_by')->textInput() ?>

    <?php //$form->field($model, 'updated_on')->textInput() ?>

    <?php //$form->field($model, 'is_deleted')->textInput() ?>

    <!--<div class="form-group">-->
        
    <!--</div>-->

    

<!--</div>-->
