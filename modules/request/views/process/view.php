<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\itr_request\models\ItrRequest */

$this->title = $model->pan_card_number;
$this->params['breadcrumbs'][] = ['label' => 'Process', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
    
?>
<section class="panel">
    <div class="panel-body">
        <div class="row" style="padding-bottom:10px;">
            <div class="col-lg-12">
                <?php
                $htmlData = '';
                if($model->created_by != Yii::$app->user->id) {
                    $htmlData = '<div class="alert alert-danger">Unauthorized Access!!!</div>';
                } else if ($model->itr_request_status == 0) {
                    $htmlData = '<div class="alert alert-danger">Unauthorized Access!!!</div>';  
                } else {
                $assessment_years_arr = explode(",", $model->assessment_years);                
                if (!empty($assessment_years_arr) && is_array($assessment_years_arr)) {
                    foreach ($assessment_years_arr as $ayear) {
                        $htmlData .= '<div style="padding-bottom:20px;"><b>Year : ' . $ayear . '</b>';
                        $htmlData .= '<div class="pull-right"></div></div>';
                        $htmlData .= $model->getImgThumbs($model->id, $ayear);
                        $htmlData .= '<hr>';
                    }
                } }
                echo $htmlData;
                ?>
            </div>
        </div>
    </div>
</section>

<!-- Image pop-->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">              
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <img src="" class="imagepreview" style="width: 100%;">
            </div>
        </div>
    </div>
</div> 


<?php
$this->registerJs("
    $(function(){  
        $(document).on('click', '.pop_kyc', function() {
            var path = $(this).find('img').attr('src');
            var new_path = path.replace('/thumbs', '');
            $('.imagepreview').attr('src', new_path);
            $('#imagemodal').modal('show');   
        });
    });
");
?>
