<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\ApplicantProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Applicant Profiles';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
        Yii::$app->request->BaseUrl . '/js/jquery.tokeninput.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerCssFile(Yii::$app->request->BaseUrl . "/css/token-input-facebook.css");
?>
<p>
    <?= Html::Button('Create Alert', ['class' => 'btn btn-success', 'id' => 'create_alert']) ?>
</p>
<section class="panel">
    <div class="panel-body">
        <div class="col-sm-9">
            <section class="panel">
                <header class="panel-heading wht-bg">
                    <h4 class="gen-case">Manage Alerts</h4>
                </header>
                <div class="panel-body minimal">
                    <div class="table-inbox-wrap ">
                        <table class="table table-inbox table-hover">
                            <tbody>
                                <?php
                                if (!empty($data)) {
                                    ?>
                                    <tr class="unread">
                                        <th></th>
                                        <th>Alerts</th>
                                        <th>Users</th>
                                        <th class="view-message  text-right">Time</th>
                                    </tr><?php
                                    foreach ($data as $dataDtl) {
                                        ?>

                                        <tr>
                                            <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                                            <td class="view-message"><?= $dataDtl['message'] ?></td>
                                            <td class="view-message"><?= $dataDtl['user_ids'] ?></td>
                                            <td class="view-message  text-right"><?= $dataDtl['created_at'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                <td class="view-message  dont-show">No Data Found</td>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>


    </div>
</section>
<?php
$this->registerJs("$(function(){   
            $('#create_alert').on('click', function() {
                var form_data = '';
                var url = '" . yii\helpers\Url::to(["manage-announacements/create-alert"]) . "';
                $('#profile_modal').modal('show');
                $.post(url, form_data,function(response) {
                    $('#modalContent').html(response);
                });
            });
            });");
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'header' => '<h4><i class="text-white fa fa-binoculars"></i> Create Alert</h4>',
    'id' => 'profile_modal',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent'><div style='text-align:center'><img src='" . Yii::$app->request->BaseUrl . "/images/acs_loader.gif'></div></div>";
yii\bootstrap\Modal::end();
?>