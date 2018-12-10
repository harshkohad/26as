<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\itr_request\models\ItrRequest */

$this->title = 'Update Itr Request: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Itr Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="itr-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
