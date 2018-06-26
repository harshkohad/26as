<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\LoanTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<section class="panel">
    <div class="panel-body">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-lg-3"><?= $form->field($model, 'loan_name')->textInput(['maxlength' => true]) ?></div>
            <div class="col-lg-3"><?= $form->field($model, 'loan_type')->dropDownList(['1' => 'ASSET VERIFICATION', '2' => 'LIABILITIES VERIFICATION', '3' => 'VENDOR VERIFICATION'], ['prompt' => 'Select Loan Type']) ?></div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="text-align: right;">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</section>

<?php //$form->field($model, 'created_by')->textInput() ?>

        <?php //$form->field($model, 'created_on')->textInput() ?>

        <?php //$form->field($model, 'updated_by')->textInput() ?>

        <?php //$form->field($model, 'updated_on')->textInput() ?>

        <?php //$form->field($model, 'is_deleted')->textInput() ?>