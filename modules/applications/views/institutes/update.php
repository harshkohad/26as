<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Institutes */

$this->title = 'Update Institute: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Institutes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="institutes-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
