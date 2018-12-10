<?php

use yii\helpers\Html;

use dosamigos\fileupload\FileUploadUI;


/* @var $this yii\web\View */
/* @var $model app\modules\itr_request\models\ItrRequest */

$this->title = 'Update Request: ' . $model->pan_card_number;
$this->params['breadcrumbs'][] = ['label' => 'Process', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pan_card_number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<section class="panel">
    <div class="panel-body">
        <div class="row" style="padding-bottom:10px;">
            <div class="col-lg-12">
                <?= FileUploadUI::widget([
                    'model' => $imgModel,
                    'attribute' => 'image_url',
                    'url' => ['upload-images'],
                    'gallery' => false,
                    'fieldOptions' => [
                        'accept' => 'image/*'
                    ],
                    'clientOptions' => [
                        'maxFileSize' => 2000000
                    ],
                    // ...
                    'clientEvents' => [
                        'fileuploaddone' => 'function(e, data) {
                                                console.log(e);
                                                console.log(data);
                                            }',
                        'fileuploadfail' => 'function(e, data) {
                                                console.log(e);
                                                console.log(data);
                                            }',
                    ],
                ]); ?>
            </div>
        </div>
        <div class="row" style="padding-bottom:10px;">
            <div class="col-lg-12">
                <?php
                    $assessment_years_arr = explode(",",$model->assessment_years);
                    $htmlData = '';
                    if(!empty($assessment_years_arr) && is_array($assessment_years_arr)) {
                        foreach($assessment_years_arr as $ayear) {                
                            $htmlData .= '<div><b>Year : '.$ayear.'</b>';
                            $htmlData .= '<div class="pull-right"> <button type="button" class="btn btn-default btn-success addImages" value="'.$model->id.'_'.$model->unique_id.'_'.$ayear.'"><i class="fa fa-plus"></i> Add Image</button> </div></div>';
                            $htmlData .= $model->getImgThumbs($model->id, $ayear);
                            $htmlData .= '<hr>';
                        }
                    }
                    echo $htmlData;
                ?>
            </div>
        </div>
    </div>
</section>

<?php
$this->registerJs("
        var assessment_years = ".json_encode($assessment_years_arr).";
    ", 3);

