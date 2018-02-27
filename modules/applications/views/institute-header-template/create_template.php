<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\manage_mobile_app\models\TblMobileUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Templates';
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
            <?= Html::Button('Create Template', ['class' => 'btn btn-success', 'id' => 'create_template']) ?>
        </p>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'attribute' => 'view',
                    'filter' => false,
                    'format' => 'raw',
                    'value' => [$searchModel, "getViewButton"],
                ]
            ],
        ]);
        ?>
    </div>
</section>
<div class="nextForm">

</div>
<?php
$this->registerJs("$(function(){   
            $('#create_template').on('click', function() {
                var form_data = '';
                var url = '" . yii\helpers\Url::to(["institute-header-template/get-next-template"]) . "';
                $('#profile_modal').modal('show');
                $.post(url, form_data,function(response) {
                    $('#modalContent').html(response);
                });
            });
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

<script type="text/javascript">
    function getForm(id) {
        
    }
</script>
