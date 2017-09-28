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
<div class="site-signup">
    <div class="container">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="box box-primary mtxxl mbxxl">
                <div class="box-header with-border">
                    <div class="box-title"><?php
                        if (Yii::$app->controller->action->id == 'create') {
                            echo '<div class="lab-single-header">
                            <a href="#" class="lab-back-to" onclick="goBack()">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                            </a>
                            <span>' . Html::encode($this->title) . '</span>
                            </div><br>';
                        } else {
                            echo "<h3 class='box-title'>" . Html::encode($this->title) . "</h3>";
                        }
                        ?></div>
                </div>
                <div class="box-body">
                    <p>Please fill out the following fields to signup:</p>
                    <?= Html::errorSummary($model) ?>
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                    <div class="">
                        <div class="col-sm-12">
                            <h3>Personal Deails</h3><hr />
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($userDetails, 'first_name') ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($userDetails, 'middle_name') ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($userDetails, 'last_name') ?>
                        </div>
                        <div class="clearfix"></div>
                        <!--<div class="col-sm-4">
                        <?php //$form->field($userDetails, 'designation') ?>
                        </div>-->
                        <div class="col-sm-4">
                            <?= $form->field($userDetails, 'mobile')->input('text', ['placeholder' => '+ followed by max 12 digits', 'maxlength' => 13]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($userDetails, 'phone')->input('text', ['placeholder' => '+ followed by max 12 digits', 'maxlength' => 13]) ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-4">
                            <?= $form->field($userDetails, 'address')->textArea() ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($userDetails, 'city') ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($userDetails, 'state') ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-4">
                            <?= $form->field($userDetails, 'country')->dropDownList(Yii::$app->commonUtility->getCountryDropdown(), ['prompt' => '(Select Country)']) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($userDetails, 'zip')->input('text', ['maxlength' => 12]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($userDetails, 'pin')->input('text', ['maxlength' => 6]) ?>
                        </div>
                        <div class="col-sm-12">
                            <h3>Account Deails</h3><hr />
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'username') ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'email') ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group text-center">
                                <?= Html::submitButton(Yii::t('rbac-admin', (Yii::$app->controller->action->id == 'create') ? 'Create' : 'Signup'), ['class' => 'btn btn-primary btn-flat', 'name' => 'signup-button']) ?>
                            </div>
                        </div>

                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
