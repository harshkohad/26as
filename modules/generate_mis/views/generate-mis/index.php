<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\select2\Select2;

$this->title = 'Generate MIS';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
        <p>
            <?php //Html::a('Create Applications', ['create'], ['class' => 'btn btn-success']) ?> 
            <?php //Html::a('Upload Applications', ['upload-applications'], ['class' => 'btn btn-warning']) ?>
        </p> 
        <div>
<!--            <table class="kv-grid-table table table-bordered table-striped kv-table-wrap">
                <thead>
                    <tr>
                        <th  width="220px">Institute</th>
                        <th width="220px">Action</th width="220px">

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($institutes as $institute) { ?>

                        <tr>
                            <td><img src="<?php echo Yii::$app->request->BaseUrl . '/' . 'images/instiutes/thumbs/' . $institute['file_name']; ?>" /></td>
                            <td><a href="/acs/web/applications/institute-header-template/download-application?institute_id=<?php echo $institute['id']; ?>" data-method="post"><i class="glyphicon glyphicon-eye-open"></i></a></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>-->
            
            <?php $form = ActiveForm::begin(['id' => 'download_template']); ?>
            <div class="row">
                <div class="col-lg-3"><?php //$form->field($model, 'institute_id')->dropDownList(ArrayHelper::map($institutes->find()->asArray()->all(), 'id', 'name'), ['prompt' => 'Select Institute'])->label('Institute Name') ?></div>
            </div>    
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>