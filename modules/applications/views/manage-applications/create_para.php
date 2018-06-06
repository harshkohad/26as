<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */

$this->title = 'Create Paragraph';
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(); ?>
<div class="pragraph-create">
    <section class="panel cust-panel panel-default">
        <div class="panel-body">
            <form>
            <div class="row">
                <div class="col-lg-3"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
                <div class="col-lg-3"><?= $form->field($model, 'paragraph_type')->dropDownList($model->getTypeOfPragraph(), ['rel' => 'resi_status']) ?></div>
                <div class="col-lg-3"><?= $form->field($model, 'type_of_verification')->dropDownList($model->getTypeOfVerification(), ['rel' => 'resi_status']) ?></div>
                <div class="col-lg-3"><?= $form->field($model, 'door_status')->dropDownList($model->getDoorLockedShif(), ['rel' => 'resi_status']) ?></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--Draggable fields-->
                    <label class="control-label" for="dynamicvartags" style=" margin-top: 0px;">Dynamic Variables</label>
                    <div id="dynamicvartags" style="height : 150px; overflow-y: scroll;">
                        <?php
                        $counter = 1;
                        foreach ($fields as $field) {
                            ?>
                            <p style="font-size: 15px;" draggable="true" id="<?= $counter ?>">{<?= $field ?>}</p>
                            <?php
                            $counter++;
                        }
                        ?>
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
                    <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
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
    });");
?>