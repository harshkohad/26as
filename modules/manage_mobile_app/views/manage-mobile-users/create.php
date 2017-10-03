<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\manage_mobile_app\models\TblMobileUsers */

$this->title = 'Create Tbl Mobile Users';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Mobile Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-mobile-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
