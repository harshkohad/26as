<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\ApplicationsUploadsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Upload History';
$this->params['breadcrumbs'][] = ['label' => 'Upload Applications', 'url' => ['upload-applications']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applications-uploads-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'institute_id',
            'loan_type_id',
            'file_name',
            'status',
            // 'created_by',
            'created_on',
            // 'updated_by',
            // 'updated_on',
            // 'is_deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
