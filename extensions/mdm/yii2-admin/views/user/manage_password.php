<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = 'Manage User Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="change-user-password-index">
    <section class="content-header">
        <h1><?= $this->title ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= yii\helpers\BaseUrl::home(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= yii\helpers\Url::toRoute('index'); ?>">Manage User</a></li>
            <li class="active">Manage Password</li>
        </ol>
    </section>
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><?= Html::encode("Change User Password") ?></strong>
        </div>
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
    </div>
    <?php
    if (!empty($model->user_id)) {
        $form = ActiveForm::begin(['id' => 'change-password']);
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>User Profile Details</strong>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($changeModel, 'newPassword')->passwordInput() ?>
                        <?= $form->field($model, 'user_id')->hiddenInput()->label(FALSE) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($changeModel, 'retypePassword') ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Change Password', ['class' => 'btn btn-success btn-flat']) ?>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">FIRST NAME</div>
                            <div class="lab-desc"><?= $userModel->userDetails->first_name ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">MIDDLE NAME</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->middle_name) ? $userModel->userDetails->middle_name : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">LAST NAME</div>
                            <div class="lab-desc"><?= $userModel->userDetails->last_name ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">USERNAME</div>
                            <div class="lab-desc"><?= $userModel->username ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">EMAIL</div>
                            <div class="lab-desc"><?= $userModel->email ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">ADDRESS</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->address) ? $userModel->userDetails->address : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">CITY</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->city) ? $userModel->userDetails->city : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">STATE</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->state) ? $userModel->userDetails->state : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">COUNTRY</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->country) ? $userModel->userDetails->country : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">PIN CODE</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->pin) ? $userModel->userDetails->pin : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">ZIP CODE</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->zip) ? $userModel->userDetails->zip : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">PHONE</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->phone) ? $userModel->userDetails->phone : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">MOBILE</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->mobile) ? $userModel->userDetails->mobile : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">DESIGNATION</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->designation) ? $userModel->userDetails->designation : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">LAST LOGIN IP</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->last_login_ip) ? $userModel->userDetails->last_login_ip : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">LAST LOGIN TIME</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->last_login_time) ? $userModel->userDetails->last_login_time : "&nbsp;" ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">CREATED AT</div>
                            <div class="lab-desc"><?= ($userModel->created_at) ? date("M d, Y", $userModel->created_at) : "&nbsp;" ?></div>
                        </div> </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">MODIFIED AT</div>
                            <div class="lab-desc"><?= ($userModel->userDetails->modified_at) ? date("M d, Y", strtotime($userModel->userDetails->modified_at)) : "&nbsp;" ?></div>
                        </div> </div>
                    <div class="col-md-4">
                        <div class="lab-field">
                            <div class="lab-lebel">STATUS</div>
                            <div class="lab-desc"><?= ($userModel->status == 10) ? "<span style=\"color:GREEN;\">Active</span>" : "<span style=\"color:RED;\">Inactive</span>" ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        ActiveForm::end();
    }
    ?>
</div>

<?php
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