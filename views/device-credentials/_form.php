<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceCredentials */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Device Credentials Details</h3>
    </div>
    <div class="panel-body">
        <div class="device-credentials-form">
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-6 form-group">
                    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

                    <?=
                            $form->field($model, 'protocol')
                            ->dropDownList(
                                    array('snmp' => 'SNMP', 'ssh' => 'SSH', 'telnet' => 'Telnet'), // Flat array ('id'=>'label')
                                    ['id' => 'protocol']    // options
                    );
                    ?>

                    <div id="div_snmp_ver" class="hidables">
                        <?= $form->field($model, 'snmp_version')->dropDownList(['v1' => 'V1', 'v2c' => 'V2c',], ['id' => 'snmp_version']) ?>
                    </div>

                    <div id="div_snmp_common" class="hidables">
                        <?= $form->field($model, 'snmp_community')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div id="div_snmp_v3" class="hidables">
                        <?= $form->field($model, 'auth_type')->dropDownList(['MD5' => 'MD5', 'SHA1' => 'SHA1', 'N/A' => 'N/A',]) ?>
                        <?= $form->field($model, 'privacy_type')->dropDownList(['DES' => 'DES', 'AES128' => 'AES128', 'N/A' => 'N/A',]) ?>
                    </div>

                    <div id="div_access_dets" class="hidables">
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'enable_password')->passwordInput(['maxlength' => true]) ?>
                    </div>
                    <?php
                    if ($canSetGlobal) :
                        echo $form->field($model, 'is_global')->checkbox();
                    endif;
                    ?>
                </div>
                <div class="col-md-6 form-group">
                    <?= $form->field($model, 'include_devices')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'exclude_devices')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'sort_order')->textInput() ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-flat' : 'btn btn-primary btn-flat']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/js/device_credentials.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>