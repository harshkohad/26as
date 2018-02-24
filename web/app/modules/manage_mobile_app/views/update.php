<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\manage_mobile_app\models\TblMobileUsers */

$this->title = 'Update Tbl Mobile Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Mobile Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-mobile-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
