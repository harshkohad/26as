<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = 'Manage User Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <header class="panel-heading"><?= Html::encode("Change User Password") ?></header>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['id' => 'manage-password-index']); ?>
        <div class="row">
            <div class="col-md-4">
                <?=
                $form->field($model, 'user_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map($userData, "id", "username"),
                    'options' => ['placeholder' => 'Select User'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label("User Name");
                ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>

<?php
    if (!empty($model->user_id)) {
    ?>
    <section class="panel">
        <header class="panel-heading">User Profile</header>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'change-password']); ?>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($changeModel, 'newPassword')->passwordInput() ?>
                    <?= $form->field($model, 'user_id')->hiddenInput()->label(FALSE) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($changeModel, 'retypePassword')->passwordInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= Html::submitButton('Change Password', ['class' => 'btn btn-success btn-flat']) ?>
                </div>
            </div>
            <?php ActiveForm::end();?>
        <div class="row">
            <div class="col-lg-12">
                <h3>Personal Deails</h3><hr />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('first_name') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->first_name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('middle_name') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->middle_name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('last_name') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->last_name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('designation') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->designation ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('mobile') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->mobile ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('phone') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->phone ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('city') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->city ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('state') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->state ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('country') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->country ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('pin') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->pin ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('address') ?></label>
                <textarea class="form-control" readonly=""><?= $userModel->userDetails->address ?></textarea>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Account Details</h3><hr />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('username') ?></label>
                <div class="readonlydiv"><?= $userModel->username ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('email') ?></label>
                <div class="readonlydiv"><?= $userModel->email ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('last_login_ip') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->last_login_ip ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('last_login_time') ?></label>
                <div class="readonlydiv"><?= $userModel->userDetails->last_login_time ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('created_at') ?></label>
                <div class="readonlydiv"><?= date("M d, Y", $userModel->created_at) ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('modified_at') ?></label>
                <div class="readonlydiv"><?= date("M d, Y", strtotime($userModel->userDetails->modified_at)) ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $userModel->getAttributeLabel('status') ?></label>
                <div class="readonlydiv"><?= ($userModel->status == 10) ? "<span style=\"color:GREEN; font-weight: bold;\" >Active</span>" : "<span style=\"color:RED; font-weight: bold;\">Inactive</span>" ?></div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
    </div>            
    </section>        
<?php
    }
$jquery = <<<JS
    $(document).ready(function () {
        $("#userdetails-user_id").on("change", function () {
            var userID = $("#userdetails-user_id").val();
            if (userID != '') {
                $('#manage-password-index').submit();
            }
        });
    });    
JS;
$this->registerJs($jquery, yii\web\View::POS_END);
