<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Update User:' . " " . "$model->username";
?>
<div class="device-credentials-update">

    <div class="lab-single-header hidden">
        <a href="#" class="lab-back-to" onclick="goBack()">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>
        <span><?= Html::encode($this->title) ?></span>
    </div><br>
    <?php $form = ActiveForm::begin(['id' => 'form-update']); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <!--<i class="fa fa-user"></i>-->
            <h3 class="panel-title">Update Profile</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($userDetails, 'first_name') ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($userDetails, 'middle_name') ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($userDetails, 'last_name') ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($model, 'username')->input('text', ['readonly' => true]) ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($model, 'email')->input('text', ['readonly' => true]) ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($userDetails, 'designation') ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($userDetails, 'mobile')->input('text', ['placeholder' => 'xxx-xxx-xxxx', 'maxlength' => 12]) ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($userDetails, 'phone')->input('text', ['placeholder' => 'xxx-xxx-xxxx', 'maxlength' => 12]) ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($userDetails, 'zip')->input('text', ['maxlength' => 12]) ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($userDetails, 'city') ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($userDetails, 'state') ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($userDetails, 'country')->dropDownList(Yii::$app->commonUtility->getCountryDropdown(), ['prompt' => '(Select Country)']) ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                
                <div class="col-lg-4">
                    <div>
                        <?= $form->field($userDetails, 'pin')->input('text', ['maxlength' => 6]) ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div>
                        <?= $form->field($userDetails, 'address')->textArea() ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
