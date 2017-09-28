<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = Yii::t('rbac-admin', 'Role Assignments');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    $usernameField,
    'first_name',
    'last_name',
    [
        'header' => "<span style='color:#337ab7;'>Role Assigned</span>",
        'format' => 'raw',
        'value' => function ($data) {
            $authManager = Yii::$app->getAuthManager();
            $roles = $authManager->getRolesByUser($data->id);
            $roleNames = array_map(function($role) {
                        return $role->name;
                    }, $roles);
            return !empty($roleNames) ? implode(", ", $roleNames) : "";
        }
    ],
];
if (!empty($extraColumns)) {
    $columns = array_merge($columns, $extraColumns);
}
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}'
];
?>
<div class="assignment-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <?php Pjax::begin(); ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $columns,
            ]);
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
