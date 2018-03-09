<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Login */

$this->title = Yii::t('rbac-admin', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">

    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'form-signin']]); ?>
    <h2 class="form-signin-heading"><img src="../../images/dvs_new_logo_hori_200_800.png" height="50"/></h2>
    <div class="login-wrap">
        <div class="user-login-info">
            <?= $form->field($model, 'username', ['inputOptions' => ['autofocus' => 'autofocus'], 'template' => "{input}{error}"])->textInput()->input('text', ['placeholder' => "Username"])->label(false); ?>
            <?= $form->field($model, 'password', ['template' => "{input}{error}"])->passwordInput()->textInput()->input('password', ['placeholder' => "Password"])->label(false); ?>
        </div>    
        <label class="checkbox">
            <?php // $form->field($model, 'rememberMe')->checkbox(['class' => 'jsRememberMeBx']) ?>
        </label>
        <?= Html::submitButton(Yii::t('rbac-admin', 'Login'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
    </div>    
    <?php ActiveForm::end(); ?>
</div>


<?php
$this->registerJs("$(function () {
    $('.jsRememberMeBx').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
    });
  });");
?>
