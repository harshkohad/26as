<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */

$this->title = 'Create Paragraph';
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pragraph-create">
    <section class="panel">
        <div class="panel-body">
            <div class="row">
                <!--Text area-->
                <div class="col-lg-6">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="inputParagraphTitle">Paragraph Title</label>
                            <input type="text" class="form-control" id="inputParagraphTitle" name="inputParagraphTitle">
                        </div>
                        <div class="form-group col-lg-12">
                            <label for="inputParagraph">Paragraph</label>
                            <textarea name="inputParagraph" rows="17" cols="78"></textarea>
                        </div>
                    </div>
                </div>
                <!--Draggable fields-->
                <div class="col-lg-6">
                    <label class="control-label" for="dynamicvartags" style=" margin-top: 0px;">Dynamic Variables</label>
                        <div id="dynamicvartags">
                            <?php
                            $counter = 1;
                            foreach ($fields as $field) {
                                ?>
                                <p style="font-size: 15px;" draggable="true" id="<?=$counter?>">{<?=$field?>}</p>
                                <?php
                                $counter++;
                            }
                            ?>
                        </div>
                </div>
            </div>
        </div>
    </section>    
</div>
<?php
$this->registerJs("$(function(){  
    document.addEventListener('dragstart', function (event) {
        event.dataTransfer.setData('Text', event.target.innerHTML);
    });
    });");
?>