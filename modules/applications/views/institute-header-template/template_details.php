<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\manage_mobile_app\models\TblMobileUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mobile Users';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
        Yii::$app->request->BaseUrl . '/js/jquery.tokeninput.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerCssFile(Yii::$app->request->BaseUrl . "/css/token-input-facebook.css");
?>
<section class="panel">
    <div class="panel-body">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::Button('Add Header', ['class' => 'btn btn-success', 'id' => 'create_header']) ?>
        <div class="container text-center">
            <table class="table table-bordered pagin-table">
                <thead>
                    <tr>
                        <th  width="220px">Header</th>
                        <th width="220px">Fields</th width="220px">

                    </tr>
                </thead>
                <?php foreach ($details as $key => $detail) { ?>
                    <tbody>
                        <tr>
                            <td><div class="form-group">
                                    <input type="text" name="institute_header[]" class="form-control" value='<?php echo $detail['header']; ?>'>
                                </div></td>
                            <td><input type="text" class="form-control" name ="institute_value[]" value='<?php echo $detail['header']; ?>'/></td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>

        </p>
    </div>
</section>

<?php
$this->registerJs("$(function(){   
            $('#create_header').on('click', function() {
                var form_data = '';
                var url = '" . yii\helpers\Url::to(["institute-header-template/create-header"]) . "';
                $('#profile_modal').modal('show');
                $.post(url, form_data,function(response) {
                    $('#modalContent').html(response);
                });
            });
            $('tbody').sortable();
            });");
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'header' => '<h4><i class="text-white fa fa-binoculars"></i> Select Institute</h4>',
    'id' => 'profile_modal',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent'><div style='text-align:center'><img src='" . Yii::$app->request->BaseUrl . "/images/acs_loader.gif'></div></div>";
yii\bootstrap\Modal::end();
?>
