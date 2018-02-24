<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

if (Yii::$app->controller->action->id == 'create') {
    $this->title = Yii::t('rbac-admin', 'Add New User');
} else {
    $this->title = Yii::t('rbac-admin', 'Signup');
}

$this->params['breadcrumbs'][] = $this->title;
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
            <div class="col-lg-3"><?= $form->field($userDetails, 'address')->textArea() ?></div>
            <div class="col-lg-3"></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Account Deails</h3><hr />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3"><?= $form->field($model, 'username') ?></div>
            <div class="col-lg-3"><?= $form->field($model, 'email') ?></div>
            <div class="col-lg-3"><?= $form->field($model, 'password')->passwordInput() ?></div>
            <div class="col-lg-3"></div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="text-align: right;">
                <?= Html::submitButton(Yii::t('rbac-admin', (Yii::$app->controller->action->id == 'create') ? 'Create' : 'Signup'), ['class' => 'btn btn-primary btn-flat', 'name' => 'signup-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>
