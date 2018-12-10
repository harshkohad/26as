<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\itr_request\models\ItrRequest */

$this->title = $model->pan_card_number;
$this->params['breadcrumbs'][] = ['label' => 'Itr Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
    <?php
        $assessment_years_arr = explode(",",$model->assessment_years);
        $htmlData = '';
        if(!empty($assessment_years_arr) && is_array($assessment_years_arr)) {
            foreach($assessment_years_arr as $ayear) {                
                $htmlData .= '<b>Year : '.$ayear.'</b>';
                $htmlData .= '<hr>';
            }
        }
        echo $htmlData;
    ?>
    </div>
</section>
