<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\TblApplicantProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-applicant-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //$form->field($model, 'id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'middle_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'pan_card_no') ?>

    <?php // echo $form->field($model, 'aadhaar_card_no') ?>

    <?php // echo $form->field($model, 'passport_number') ?>

    <?php // echo $form->field($model, 'mobile_no') ?>

    <?php // echo $form->field($model, 'itr_ack_number') ?>

    <?php // echo $form->field($model, 'bank_account_number') ?>

    <?php // echo $form->field($model, 'bank_statement_type') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'created_on') ?>

    <?php // echo $form->field($model, 'update_on') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
