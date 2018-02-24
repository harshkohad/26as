<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\manage_mobile_app\models\TblMobileUsers */

$this->title = 'Update Mobile User: ' . $model->field_agent_name;
$this->params['breadcrumbs'][] = ['label' => 'Mobile Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->field_agent_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-mobile-users-update">

    <?= $this->render('_form', [
        'model' => $model,
        "type" => "update"
    ]) ?>

</div>
