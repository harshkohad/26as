<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use app\modules\applications\models\InstituteHeaderTemplate;

$templateModel = new InstituteHeaderTemplate();
/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */
/* @var $form yii\widgets\ActiveForm */
$form = ActiveForm::begin(['id' => 'create_command', 'action' => 'save-header']);
?>


<div class="container text-center">
    <table class="table table-bordered pagin-table">
        <thead>
            <tr>
                <th  width="220px">Header</th>
                <th width="220px">Fields</th width="220px">

            </tr>
        </thead>
        <tbody>
            <tr>
                <td><div class="form-group">
                        <?= $form->field($model, 'header')->textInput(['maxlength' => 255, 'class' => 'form-control']); ?>
                        <?= $form->field($model, 'institute_id')->hiddenInput(['maxlength' => 255, 'class' => 'form-control'])->label(FALSE); ?>
                    </div></td>
                <td><?= $form->field($model, 'fields')->textInput(['maxlength' => 255, 'class' => 'form-control', "id" => "tokeninput"]); ?></td>
                <td><div class="col-lg-12" style="text-align: right;">
                        <?= Html::Button('Add', ['class' => 'btn btn-success', 'id' => 'add_header']) ?>
                    </div></td>
            </tr>
        </tbody>
    </table>

</div>
<?php ActiveForm::end(); ?>
<?php
$this->registerJs("$(function(){   
            $('#add_header').on('click', function() {
               var form_data = $('#create_command').serialize();
               var url = '" . yii\helpers\Url::to(["institute-header-template/save-header"]) . "';
                $.post(url, form_data,function(response) {
                    window.location.reload();
                });
            });
            });");

$json_input = $templateModel->getJsonInput();
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#tokeninput").tokenInput(<?php echo $json_input; ?>, {
            theme: "facebook",
        });
    });

</script>

<style>
    div.token-input-dropdown-facebook {           
        z-index: 11001 !important;
    }
    .table {
        width: 69%;
        max-width: 100%;
        margin-bottom: 20px;
    }
</style>