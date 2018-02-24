<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */
/* @var $form yii\widgets\ActiveForm */

?>
<?php $form = ActiveForm::begin(['id' => 'institute_form', 'action' => 'next-template-form']); ?>
<section class="panel">
    <div class="panel-body">

        <div class="row">
            <div class="col-lg-3"><?= $form->field($institutes, 'id')->dropDownList(ArrayHelper::map($institutes->find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Select Institute'])->label('Institute Name') ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="text-align: right;">
            <?= Html::submitButton('Next', ['class' => 'btn btn-success', 'id' => 'next_button']) ?>
        </div>
    </div>

</section>
<?php ActiveForm::end(); ?>
<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'header' => '<h4><i class="text-white fa fa-university"></i> Select Institues</h4>',
    'id' => 'profile_modal',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent'><div style='text-align:center'><img src='" . Yii::$app->request->BaseUrl . "/images/acs_loader.gif'></div></div>";
yii\bootstrap\Modal::end();
?>

<?php
$this->registerJs("
        $(function(){   
            $('#next_button').on('click', function() {
            alert('adasdasd');return false;
                var form_data = $('#institute_form').serialize();
                var url = '" . yii\helpers\Url::to(["manage-mobile-users/next-template-form"]) . "';
                $('#profile_modal').modal('show');
                $.post(url, form_data,function(response) {
                    $('#modalContent').html(response);
                });
            }); 
        });
    ");
$url = yii\helpers\Url::to(["manage-mobile-users/next-template-form"]);
?>
<script>
    $('#next_button').on('click', function () {
        var url = '<?php echo $url; ?>'
        var form_data = $('#institute_form').serialize();
        $('#profile_modal').modal('show');
        $.post(url, form_data, function (response) {
            $('#modalContent').html(response);
        });
    });
</script>
