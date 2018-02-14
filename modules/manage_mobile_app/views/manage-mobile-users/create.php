<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\manage_mobile_app\models\TblMobileUsers */

$this->title = 'Create Mobile User';
$this->params['breadcrumbs'][] = ['label' => 'Mobile Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-mobile-users-create">

    <?= $this->render('_form', [
        'model' => $model,
        "userData" => $userData,
        "type" => "create"
    ]) ?>

</div>
