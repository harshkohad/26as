<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

if (Yii::$app->controller->action->id == 'create') {
    $this->title = Yii::t('rbac-admin', 'Add New User');
} else {
    $this->title = Yii::t('rbac-admin', 'Signup');
}

$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
        Yii::$app->request->BaseUrl . '/js/jquery.tokeninput.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerCssFile(Yii::$app->request->BaseUrl . "/css/token-input-facebook.css");
?>
<section class="panel">
    <div class="panel-body">
        <?= Html::errorSummary($model) ?>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="row">
            <div class="col-lg-12">
                <h3>Personal Deails</h3><hr />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3"><?= $form->field($userDetails, 'first_name') ?></div>
            <div class="col-lg-3"><?= $form->field($userDetails, 'middle_name') ?></div>
            <div class="col-lg-3"><?= $form->field($userDetails, 'last_name') ?></div>
            <div class="col-lg-3"><?= $form->field($userDetails, 'designation') ?></div>
        </div>
        <div class="row">
            <div class="col-lg-3"><?= $form->field($userDetails, 'mobile')->input('text', ['placeholder' => '+ followed by max 12 digits', 'maxlength' => 13]) ?></div>
            <div class="col-lg-3"><?= $form->field($userDetails, 'phone')->input('text', ['placeholder' => '+ followed by max 12 digits', 'maxlength' => 13]) ?></div>
            <div class="col-lg-3"><?= $form->field($userDetails, 'city') ?></div>
            <div class="col-lg-3"><?= $form->field($userDetails, 'state') ?></div>
        </div>
        <div class="row">
            <div class="col-lg-3"><?= $form->field($userDetails, 'country')->dropDownList(Yii::$app->commonUtility->getCountryDropdown(), ['prompt' => '(Select Country)']) ?></div>
            <div class="col-lg-3"><?= $form->field($userDetails, 'pin')->input('text', ['maxlength' => 6]) ?></div>
            <div class="col-lg-4"><?= $form->field($userDetails, 'address')->textArea() ?></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Account Details</h3><hr />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3"><?= $form->field($model, 'username') ?></div>
            <div class="col-lg-3"><?= $form->field($model, 'email') ?></div>
            <div class="col-lg-3"><?= $form->field($model, 'password')->passwordInput() ?></div>
            <div class="col-lg-3"><?= $form->field($userDetails, 'role_id')->dropDownList($roles, ['prompt' => 'Select Role'])->label('Role') ?></div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="text-align: right;">
                <?= Html::submitButton(Yii::t('rbac-admin', (Yii::$app->controller->action->id == 'create') ? 'Create' : 'Signup'), ['class' => 'btn btn-primary btn-flat', 'name' => 'signup-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>


<style>
    .table {
        width: 69%;
        max-width: 100%;
        margin-bottom: 20px;
    }
</style>