<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Login */

$this->title = Yii::t('rbac-admin', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box">
    <div class="login-logo">
        <!--<a href="#" style="color: white;"><b>(SWIM)</b></a>-->
        <img src="<?php echo \yii\helpers\Url::to(Yii::$app->view->theme->baseUrl . '/images/cisco_logo.png') ?>" alt="STC" /><br/>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        <p class="login-box-msg">Sign in to start your session</p>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?= $form->field($model, 'username', ['inputOptions' => ['autofocus' => 'autofocus'], 'template' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>{error}"])->textInput()->input('username', ['placeholder' => "Username"])->label(false); ?>
        <?= $form->field($model, 'password', ['template' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>{error}"])->passwordInput()->textInput()->input('password', ['placeholder' => "Password"])->label(false); ?>

        <div class="row">
            <div class="col-xs-8">
                <div class="icheck">
                    <label>
                        <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'jsRememberMeBx']) ?>
                    </label>
                </div>
            </div>
            <div class="col-xs-4">
                <?= Html::submitButton(Yii::t('rbac-admin', 'Login'), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>

        <div style="color:#999;margin:1em 0">
            <p>Don't remember password ? <?= Html::a('reset it', ['user/request-password-reset']) ?></p>
            <p>Don't have an account ? <?= Html::a('signup', ['user/signup']) ?></p>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php
$this->registerJs("$(function () {
    $('.jsRememberMeBx').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
    });
  });");
?>
