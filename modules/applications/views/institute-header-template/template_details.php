<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\manage_mobile_app\models\TblMobileUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Institute Template Headers : " . $institute_name;
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
        Yii::$app->request->BaseUrl . '/js/jquery.tokeninput.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerCssFile(Yii::$app->request->BaseUrl . "/css/token-input-facebook.css");
?>
<?php $form = ActiveForm::begin(['id' => 'final_fields', 'action' => '']); ?>
<?= $form->field($model, 'id')->hiddenInput()->label(false); ?>
<section class="panel">
    <div class="panel-body">
        <p>
            <?= Html::Button('Add Header', ['class' => 'btn btn-success', 'id' => 'create_header']) ?>
            <?= Html::Button('Submit', ['class' => 'btn btn-info', 'id' => 'save_button']) ?>
            <?= Html::a('download', ['institute-header-template/download-application'], ['class' => 'btn-primary btn']) ?>
        </p>       
        <div>
            <table class="kv-grid-table table table-bordered table-striped kv-table-wrap">
                <thead>
                    <tr>
                        <th  width="220px">Header</th>
                        <th width="220px">Fields</th width="220px">
                        <th width="20px">Remove</th width="220px">

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($details as $key => $detail) { ?>

                        <tr class='remove_<?php echo $key; ?>'>
                            <td><div class="form-group">
                                    <input type="text" name="institute_header[]" class="form-control" readonly value='<?php echo $detail['header']; ?>'>
                                </div></td>
                            <td><input type="text" class="form-control" name ="institute_value[]" readonly value='<?php echo $detail['field']; ?>'/></td>
                            <td style="color:red;font-size: 35px;"><?= Html::button('<i class="glyphicon glyphicon-remove-sign"></i>', ['header' => $detail['header'], 'field' => $detail['field'], 'style' => 'color:red;', 'class' => 'remove_tr', 'rel' => $key]) ?></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php ActiveForm::end(); ?>
<?php
$this->registerJs("$(function(){   
    $('tbody').sortable({
        tolerance: 'touch',
        drop: function () {
            alert('delete!');
        }
    });
        $('tbody').sortable();
            $('#create_header').on('click', function() {
                var form_data = '';
                var url = '" . yii\helpers\Url::to(["institute-header-template/create-header"]) . "';
                $('#profile_modal').modal('show');
                var form_data = $('#final_fields').serialize();
                $.post(url, form_data,function(response) {
                    $('#modalContent').html(response);
                });
            });
            
            $('#save_button').on('click', function() {
               var form_data = $('#final_fields').serialize();
                var url = '" . yii\helpers\Url::to(["institute-header-template/save-final-header"]) . "';
                $.post(url, form_data,function(response) {
                    window.location.reload();
                });
            });
            $('.remove_tr').on('click', function() {
              
                        var rel = $(this).attr('rel');
                        $('.remove_'+rel).remove();
                        var form_data = '';
                        var url = '" . yii\helpers\Url::to(["institute-header-template/save-updated-header"]) . "';
                        $('#profile_modal').modal('show');
                        var form_data = $('#final_fields').serialize();
                        $.post(url, form_data,function(response) {
                            $('#modalContent').html(response);
                        });
             });
            
            });");
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'header' => '<h4><i class="text-white fa fa-binoculars"></i> Create Header</h4>',
    'id' => 'profile_modal',
    'size' => 'modal-lg',
    'options' => ['tabindex' => ''],
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent'><div style='text-align:center'><img src='" . Yii::$app->request->BaseUrl . "/images/acs_loader.gif'></div></div>";
yii\bootstrap\Modal::end();
?>


<style type="text/css">
    input {font-weight:bold;}
    .btn-primary {
        background-color: #95b75d;
        border-color: #1fb5ad;
        color: #FFFFFF;
        text-align: center;
        padding: 9px;
        float: right;
    }
</style>