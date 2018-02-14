<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\ApplicantProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Applicant Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Add Applicant Profile', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                'first_name',
                'middle_name',
                'last_name',
                'pan_card_no',
                'aadhaar_card_no',
                'passport_number',
                // 'mobile_no',
                // 'itr_ack_number',
                // 'bank_account_number',
                // 'bank_statement_type',
                // 'address',
                // 'created_on',
                // 'update_on',
                // 'is_deleted',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
</section>
