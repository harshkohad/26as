<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\itr_request\models\ItrRequest */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
        Yii::$app->request->BaseUrl . '/js/jquery.tokeninput.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerCssFile(Yii::$app->request->BaseUrl . "/css/token-input-facebook.css");
?>
<section class="panel">
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-3"><?= $form->field($model, 'pan_card_number')->textInput(['maxlength' => true]) ?></div>
            <div class="col-lg-6"><?= $form->field($model, 'assessment_years')->textInput(["id" => "tokeninput"]); ?></div>
        </div>
        <div class="row">
            <div class="col-lg-3"><div id="panFound"></div></div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="text-align: right;">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>
<?php
$ay_data = '[{"id":"13-14","name":"13-14"},{"id":"14-15","name":"14-15"},{"id":"15-16","name":"15-16"},{"id":"16-17","name":"16-17"},{"id":"17-18","name":"17-18"},{"id":"18-19","name":"18-19"}]';
$this->registerJs("$(function(){
        $('#tokeninput').tokenInput($ay_data, {
            theme: 'facebook',
            preventDuplicates: true,
        });
        $('#request-pan_card_number').focusout(function(){
            var pan_card_number = $('#request-pan_card_number').val();
            $.post('check-pan?pannumber='+pan_card_number, {'data': ''}, function (response) {
                $('#panFound').html(response);
                setTimeout(function() { 
                    $('#panFound').html('');
                }, 3000);
            });
        });
});");
?>