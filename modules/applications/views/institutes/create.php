<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Institutes */

$this->title = 'Create Institutes';
$this->params['breadcrumbs'][] = ['label' => 'Institutes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institutes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
