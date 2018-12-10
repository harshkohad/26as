<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\itr_request\models\ItrRequest */

$this->title = 'Create Request';
$this->params['breadcrumbs'][] = ['label' => 'Itr Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itr-request-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
