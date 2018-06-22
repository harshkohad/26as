<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */

$title = isset($_GET['id']) ? 'Update' : 'Create';

$this->title = $title . ' Paragraph';
$this->params['breadcrumbs'][] = ['label' => 'Manage Paragraph', 'url' => ['manage-paragraphs']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
        '@web/js/jquery-1.11.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<?php $form = ActiveForm::begin(); ?>
<div class="pragraph-create">
    <section class="panel cust-panel panel-default">
        <div class="panel-body">
            <form>
                <div class="row">
                    <div class="col-lg-3"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
                    <div class="col-lg-3"><?= $form->field($model, 'paragraph_type')->dropDownList($model->getTypeOfPragraph(), ['rel' => 'resi_status', 'prompt' => 'Select Paragraph Type']) ?></div>
                    <div class="col-lg-3"><?= $form->field($model, 'type_of_verification')->dropDownList($model->getTypeOfVerification(), ['prompt' => 'Select Type of verification', 'rel' => 'resi_status']) ?></div>
                    <div class="col-lg-3"><?= $form->field($model, 'door_status')->dropDownList($model->getDoorLockedShif(), ['rel' => 'resi_status', 'prompt' => 'Select Door Status']) ?></div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!--Draggable fields-->
                        <label class="control-label" for="dynamicvartags" style=" margin-top: 0px;">Dynamic Variables</label>
                        <div id="dynamicvartags" style="height : 150px; overflow-y: scroll;">
                            
                        </div>
                        <br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($model, 'paragraph')->textArea(['maxlength' => true, 'rows' => 9]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= Html::submitButton($title, ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </form>
        </div>
    </section>    
</div>
<?php ActiveForm::end(); ?>
<?php
$this->registerJs("$(function(){  
    document.addEventListener('dragstart', function (event) {
        event.dataTransfer.setData('Text', event.target.innerHTML);
    });
    $('#applicationparagraph-type_of_verification').on('change', function () {
            var status = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'get-fields',
                data: 'status=' + status,
                success: function (data) {
                    $('#dynamicvartags').html(data);
                }
            });
        });
    
    });");
?>


