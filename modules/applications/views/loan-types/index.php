<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\LoanTypesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Loan Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <p>
            <?= Html::a('Create Loan Type', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                //'id',
                'loan_name',
                [
                    'attribute' => 'loan_type',
                    'label' => 'Loan Type',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->getLoanType($model->loan_type);
                    },
                    'filter' => ['1' => 'ASSET VERIFICATION', '2' => 'LIABILITIES VERIFICATION', '3' => 'VENDOR VERIFICATION'],
                ],
                [
                    'attribute' => 'created_by',
                    'label' => 'Created By',
                    'value' => function ($data) {
                        if ($data->created_by == NULL) {
                            return "Not Generated";
                        } else {
                            $user_details = User::findIdentity($data->created_by);

                            if (!empty($user_details->username))
                                return $user_details->username;
                            else
                                return 'Not Found';
                        }
                    },
                ],
                'created_on',
                // 'updated_by',
                // 'updated_on',
                // 'is_deleted',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
</section>

