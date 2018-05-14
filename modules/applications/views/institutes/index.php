<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\InstitutesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Institutes';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Create Institute', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'name',
                //'download_pdf',
                //'download_excel',
                //'char_count',
                // 'is_alphanumeric',
                // 'file_name',
                // 'is_active',
                // 'created_by',
                // 'created_on',
                // 'updated_by',
                // 'updated_on',
                // 'is_deleted',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
</section>
