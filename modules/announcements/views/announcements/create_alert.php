<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use app\modules\announcements\models\AlertHistory;

$alertModel = new AlertHistory();
/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */
/* @var $form yii\widgets\ActiveForm */
$form = ActiveForm::begin(['id' => 'create_alert_form', 'action' => 'create-alert']);
?>


<div class="container text-center">
    <div class="form-group">
        <?= $form->field($model, 'is_all')->checkbox(); ?>
    </div>
    <table class="table table-bordered pagin-table">


        <thead>
            <tr>
                <th  width="220px">Header</th>
                <th width="220px">Fields</th width="220px">

            </tr>
        </thead>
        <tbody>
            <tr class="user_selected">
                <td>
                    <div class="form-group">
                        <?= $form->field($model, 'message')->textarea(['maxlength' => 255, 'class' => 'form-control']); ?>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <?= $form->field($model, 'user_ids')->textInput(['maxlength' => 255, 'class' => 'form-control', "id" => "tokeninput"]); ?>
                    </div>
                </td>
                <td>
                    <div class="col-lg-12" style="text-align: right;">
                        <?= Html::Button('Submit', ['class' => 'btn btn-success', 'id' => 'add_alert']) ?>
                    </div></td>
            </tr>
        </tbody>


    </table>
    <!--    <div class="col-lg-12"">
            <?//= Html::Button('Submit', ['class' => 'btn btn-success', 'id' => 'add_alert']) ?>
        </div>-->

</div>
<?php ActiveForm::end(); ?>
<?php
$this->registerJs("$(function(){   
            $('#add_alert').on('click', function() {
               var form_data = $('#create_alert_form').serialize();
               var url = '" . yii\helpers\Url::to(["manage-announcements/create-alert"]) . "';
                $.post(url, form_data,function(response) {
                    window.location.reload();
                });
            });
            });");
$json_input = $alertModel->getEmployeeList();
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#tokeninput").tokenInput(<?php echo $json_input; ?>, {
            theme: "facebook",
        });
    });
//    $('#add_alert').on('click', function () {
//        var form_data = $('#create_alert').serialize();
//        alert(form_data);
//        return false;
////        var url = '" . yii\helpers\Url::to(["manage-announcements/create-alert"]) . "';
////        $.post(url, form_data, function (response) {
////            alert(response);
////            //window.location.reload();
////        });
//    });

//    $("#alerthistory-is_all").is(":checked")
    if ($("#alerthistory-is_all").is(':checked') == true) {
        alert($(this).val());
    }

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