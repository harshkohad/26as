<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\PasswordResetRequest */

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>STC</b> My View</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        <div class="site-request-password-reset">
            <p class="login-box-msg"><strong><?= Html::encode($this->title) ?></strong></p>

            <p>Please fill out your email. A link to reset password will be sent there.</p>
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'email', ['template' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>{error}"])->textInput()->input('email', ['placeholder' => "Email ID"])->label(true) ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('rbac-admin', 'Send'), ['class' => 'btn btn-primary btn-flat pull-right']) ?>
                <div class="clearfix"></div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>