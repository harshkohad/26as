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

            <div class="row">
                <!--Text area-->
                <form>
                    <div class="col-lg-6 ">
                        <div class="row">
                            <div class="col-lg-3"><?= $form->field($model, 'type_of_verification')->dropDownList($model->getTypeOfVerification(), ['rel' => 'resi_status']) ?></div>
                            <div class="col-lg-3"><?= $form->field($model, 'door_status')->dropDownList($model->getDoorLockedShif(), ['rel' => 'resi_status']) ?></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
                            <div class="form-group col-lg-12">
                                <div class="col-lg-9"><?= $form->field($model, 'paragraph')->textArea(['maxlength' => true, 'rows' => 17]) ?></div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary" id="itr_submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--Draggable fields-->
                <div class="col-lg-6">
                    <label class="control-label" for="dynamicvartags" style=" margin-top: 0px;">Dynamic Variables</label>
                    <div id="dynamicvartags">
                        <?php
                        $counter = 1;
                        foreach ($fields as $key => $field) {
                            ?>
                            <div class="row">
                                <div class="form-group col-lg-3"><p style="font-size: 15px;" draggable="true" id="<?= $counter ?>">{<?= $fields[$key] ?>}</p></div>
                                <?php
                                if (isset($fields[$key + 1])) {
                                    $key++;
                                    ?>
                                    <div class="form-group col-lg-3">
                                        <p style="font-size: 15px;" draggable="true" id="<?= $counter ?>">{<?= $fields[$key] ?>}</p>
                                    </div>

                                    <?php
                                    $counter++;
                                };
                                ?>
                                </p>
                            </div>

                            <?php
                            $counter++;
                        }
                        ?>
                    </div>
                </div>



            </div>
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