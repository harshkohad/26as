<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\manage_mobile_app\models\TblMobileUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Download Template";
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['id' => 'download_template']); ?>
<section class="panel">
    <div class="panel-body">

        <div class="row">
            <div class="col-lg-3"><?= $form->field($model, 'institute_id')->dropDownList(ArrayHelper::map($institutes->find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Select Institute'])->label('Institute Name') ?></div>
            <div class="col-lg-3"><?php
                echo '<b>Start Date</b>';
                echo DatePicker::widget([
                    'name' => 'start_date',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
//                                'template' => '{addon}{input}',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'endDate' => '0d',
                        'todayHighlight' => true
                    ]
                ]);
                ?></div>
            <div class="col-lg-3"><?php
                echo '<b>End Date</b>';
                echo DatePicker::widget([
                    'name' => 'end_date',
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
//                                'template' => '{addon}{input}',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                        'endDate' => '0d',
                        'todayHighlight' => true
                    ]
                ]);
                ?></div>
            <div class="col-lg-3"> <?= Html::submitButton('Download', ['class' => 'btn-primary btn', 'id' => 'save_button']) ?></div>
        </div>

    </div>
</section>
<?php ActiveForm::end(); ?>
<style type="text/css">
    input {font-weight:bold;}
    .btn-primary {
        background-color: #95b75d;
        border-color: #1fb5ad;
        color: #FFFFFF;
        margin-top: "10px";
        /*text-align: center;*/
        /*padding: 9px;*/
        /*float: right;*/
    }
</style>