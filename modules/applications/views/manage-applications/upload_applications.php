<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */

$this->title = 'Upload Applications';
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">

        <p>
            <?= Html::a('Download Sample excel', ['sample-template'], ['class' => 'btn btn-success'], ['target' => '_blank']) ?>
            <?= Html::a('History', ['upload-history'], ['class' => 'btn btn-warning']) ?>
        </p>
        <form id="upe_form" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-3">
                    <label>Select Institute</label>
                    <?= Html::dropDownList('institute_id', null, $institutes, array('label' => 'Select Institute', 'class' => 'form-control')) ?>
                </div>
                <div class="col-lg-3">
                    <label>Select Loan Type</label>
                    <?= Html::dropDownList('loan_type_id', null, $loantypes, array('label' => 'Select Loan Type', 'class' => 'form-control')) ?>
                </div>
                <div class="col-lg-6">                
                    <div class="form-group">
                        <label>Upload Excel</label>
                        <input class="form-control" name="upe_file" type="file">
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="upe_footer" class="col-lg-12">
                    <div id="button_div">
                        <button type="submit" class="btn btn-primary" id="upe_submit">Upload</button>
                    </div>
                    <div id="loader_div" style="display: none;">
                        Uploading.... <img src='<?php echo Yii::$app->request->BaseUrl; ?>/images/acs_loader.gif'>
                    </div>
                </div>
            </div>
        </form>    
    </div>
</section>
<section class="panel">
    <div class="panel-body">
        <div class="col-lg-12" >
            <p id="final_submit" style="display: none; float: right;">
                <button type="button" class="btn btn-success" id="upe_final_submit">Submit</button>
            </p>
            <div id="response_div" style="display: none; clear: both;">
            </div>
            <input type="hidden" id="uploaded_id" name="uploaded_id" />
        </div>
    </div>
</section>
<div class="floatingResponse alert ">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <div id="responsemsg"> </div>
</div>

<?php
$this->registerJs("
        $(function(){
            var loader_link = '" . Yii::$app->request->BaseUrl . "/images/acs_loader.gif';
            $('#upe_form').on('submit',(function(e) {
                $('#button_div').hide();
                $('#loader_div').show();
                $('#response_div').html('');
                $('#final_submit').hide();
                $('#uploaded_id').val('');
                e.preventDefault();
                $.ajax({
                    url: 'upload-applications-excel', // Url to which the request is send
                    type: 'POST',             // Type of request to be send, called as method
                    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(data)   // A function to be called if request succeeds
                    {
                        $('#loader_div').hide();
                        $('#button_div').show();
                        floatingResponse(data);
                        var obj = JSON.parse(data);
                        $('#loader_div').hide();
                        $('#final_submit').show();
                        $('#response_div').show();
                        $('#response_div').html(obj.html);
                        $('#uploaded_id').val(obj.id);
                    }
                });
            }));
            
            $('#upe_final_submit').on('click',(function(e) {
                var uploaded_id = $('#uploaded_id').val();
                $('#final_submit').hide();
                $('#uploaded_id').val('');
                $('#response_div').html('Submitting!!! <img src='+loader_link+'>');
                var data = {id: uploaded_id};
                //ajax call
                $.post('submit-u-excel', data, function (response) {
                    $('#response_div').html('');
                    $('#response_div').hide();
                    floatingResponse(response);
                });
            }));
            
            function floatingResponse(response){
                var obj = JSON.parse(response);
                $('#responsemsg').html(obj.msg);
                $('.floatingResponse').removeClass('alert-success');
                $('.floatingResponse').removeClass('alert-error');
                if(obj.status == 'success') {
                    $('.floatingResponse').addClass('alert-success');
                } else {
                    $('#final_submit').hide();
                    $('.floatingResponse').addClass('alert-error');
                }
                $('.floatingResponse').show();
                setTimeout(function(){
                    $('.floatingResponse').hide(); 
                }, 3000);
            }
        }); 
        ");
