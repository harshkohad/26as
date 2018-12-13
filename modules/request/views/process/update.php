<?php

use yii\helpers\Html;

//use dosamigos\fileupload\FileUploadUI;


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
                <?php
                $htmlData = '';
                if ($model->itr_request_status == 2) {
                    $htmlData = '<div class="alert alert-danger">Unauthorized Access!!!</div>';
                } else {
                    $assessment_years_arr = explode(",", $model->assessment_years);
                    if (!empty($assessment_years_arr) && is_array($assessment_years_arr)) {
                        foreach ($assessment_years_arr as $ayear) {
                            $htmlData .= '<div style="padding-bottom:20px;"><b>Year : ' . $ayear . '</b><div class="pull-right">';
                            $htmlData .= '<button type="button" class="btn btn-default btn-success addImages" value="' . $model->unique_id . '_' . $ayear . '"><i class="fa fa-plus"></i> Add Image</button>';
                            $htmlData .= '</div></div>';
                            $htmlData .= $model->getImgThumbs($model->id, $ayear);
                            $htmlData .= '<hr>';
                        }
                    }
                }
                echo $htmlData;
                ?>
            </div>
        </div>
        <?php if ($model->itr_request_status != 2) { ?>
            <div class="row" style="padding-bottom:10px;">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-default btn-info pull-right submitRequest" value="<?= $model->id ?>">Submit</button>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<!--Upload Photos modal-->    
<div class="modal fade" id="modal-photos-upload">
    <div class="modal-dialog" style="width: 1200px !important;">
        <div class="modal-content">
            <div class="modal-header label-success">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <i class="text-white fa fa-pencil-square-o"></i><span class="text-white bold">Upload : </span><span id="modal_heading"></span>
                </h4>
            </div>
            <div class="modal-body" id="photos_modal_body">
                <div class="row" id="crop_form">
                    <div class="col-lg-12">
                        <form id="cropimage" method="post" enctype="multipart/form-data" action="temp-upload">
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="photoimg" id="photoimg" />
                            </div>
                            <input type="hidden" name="hdn-x1-axis" id="hdn-x1-axis" value="" />
                            <input type="hidden" name="hdn-y1-axis" id="hdn-y1-axis" value="" />
                            <input type="hidden" name="hdn-x2-axis" value="" id="hdn-x2-axis" />
                            <input type="hidden" name="hdn-y2-axis" value="" id="hdn-y2-axis" />
                            <input type="hidden" name="hdn-thumb-width" id="hdn-thumb-width" value="" />
                            <input type="hidden" name="hdn-thumb-height" id="hdn-thumb-height" value="" />
                            <input type="hidden" name="action" value="" id="action" />
                        </form>
                    </div>
                </div>
                <div class="row" id="final_form" style="display:none;">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="image_remarks" class="col-form-label">Remarks:</label>
                            <textarea class="form-control"  name="image_remarks" id="image_remarks"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">    
                        <div id='preview-avatar-profile'></div>
                        <input type="hidden" name="image_name" value="" id="image_name" />   
                        <input type="hidden" name="request_id" id="request_id" value="<?= $model->id; ?>" />
                        <input type="hidden" name="unique_id" id="unique_id" value="" />
                        <input type="hidden" name="as_year" id="as_year" value="" />
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="photos_modal_footer">
                <div id="button_photos_div">
                    <!--<button type="button" class="btn btn-primary" id="photos_submit"><i class="fa fa-chevron-right"></i>Next</button>-->
                    <button type="button" class="btn btn-success" id="photos_submit" style="display: none;">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                </div>
                <div id="modal_loader_div" style="display: none;">
                    Uploading.... <img src='<?php echo Yii::$app->request->BaseUrl; ?>/images/acs_loader.gif'>
                </div>
                <div id="modal_response_div" style="display: none; padding-top: 10px;">
                </div>
            </div>
        </div>
    </div>
</div>
<?php
//$this->registerJs("
//        var assessment_years = ".json_encode($assessment_years_arr).";
//    ", 3);
?>

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
        $('.addImages').on('click', function() {
            // Call Modal
            var image_data = this.value.split('_');
            var unique_id = image_data[0];
            var as_year = image_data[1];

            $('#unique_id').val(unique_id);
            $('#as_year').val(as_year);
            $('#modal_heading').html(as_year);
            $('#modal-photos-upload').modal('show'); 
        });
        
        $('#photoimg').on('change', function() { 
            $('#preview-avatar-profile').html('');
            $('#modal_loader_div').show();
            $('#cropimage').ajaxForm(
            {
            target: '#preview-avatar-profile',
            success: function() { 
                        $('img#photo').imgAreaSelect({
                        //aspectRatio: '1:1',
                        onSelectEnd: getSizes,
                    });
                    $('#modal_loader_div').hide();
                    $('#image_name').val($('#photo').attr('file-name'));
                    $('#final_form').show();
                    $('#photos_submit').show();
                }
            }).submit();
	});
        
        function getSizes(img, obj)
        {
            var x_axis = obj.x1;
            var x2_axis = obj.x2;
            var y_axis = obj.y1;
            var y2_axis = obj.y2;
            var thumb_width = obj.width;
            var thumb_height = obj.height;
            if(thumb_width > 0)
                {

                    $('#hdn-x1-axis').val(x_axis);
                    $('#hdn-y1-axis').val(y_axis);
                    $('#hdn-x2-axis').val(x2_axis);
                    $('#hdn-y2-axis').val(y2_axis);
                    $('#hdn-thumb-width').val(thumb_width);
                    $('#hdn-thumb-height').val(thumb_height);

                }
            else
                alert('Please select portion..!');
        }
        
        $('#photos_submit').on('click', function() {
            $('#modal_loader_div').show();
            params = {
                targetUrl: 'save-cropped-image',
                action: 'save',
                x_axis: $('#hdn-x1-axis').val(),
                y_axis : $('#hdn-y1-axis').val(),
                x2_axis: $('#hdn-x2-axis').val(),
                y2_axis : $('#hdn-y2-axis').val(),
                thumb_width : $('#hdn-thumb-width').val(),
                thumb_height:$('#hdn-thumb-height').val()
            };
            saveCropImage(params);
        });
        
        function saveCropImage(params) {
        params['image_name'] = $('#image_name').val();
        params['request_id'] = $('#request_id').val();
        params['unique_id'] = $('#unique_id').val();
        params['as_year'] = $('#as_year').val();
        params['image_remarks'] = $('#image_remarks').val();
        
        $.ajax({
            url: params['targetUrl'],
            cache: false,
            dataType: 'html',
            data: {
                action: params['action'],
                t: 'ajax',
                w1:params['thumb_width'],
                x1:params['x_axis'],
                h1:params['thumb_height'],
                y1:params['y_axis'],
                x2:params['x2_axis'],
                y2:params['y2_axis'],
                image_name:params['image_name'],
                request_id:params['request_id'],
                unique_id:params['unique_id'],
                as_year:params['as_year'],
                image_remarks:params['image_remarks'],
            },
            type: 'Post',
            success: function (response) {
                $('#modal_loader_div').hide();
                if(!jQuery.isEmptyObject(response)) {
                    var obj = jQuery.parseJSON(response);
                    var div_type = obj.status;
                    $('#modal_response_div').html('<div class=\"alert alert-'+div_type+'\">'+obj.msg+'</div>');
                    $('#modal_response_div').show();
                }
                clearCropTool();                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('status Code:' + xhr.status + 'Error Message :' + thrownError);
            }
        }); 
        }
        
        $('#modal-photos-upload').on('hidden.bs.modal', function () {
            clearCropTool();
        })
        
        function clearCropTool() {
            $('.imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-selection,.imgareaselect-outer').css('display', 'none');
            $('#preview-avatar-profile').html('');
            $('#photoimg').val();
            $('#final_form').hide();
            $('#photoimg').val();
            $('#hdn-x1-axis').val();
            $('#hdn-y1-axis').val();
            $('#hdn-x2-axis').val();
            $('#hdn-y2-axis').val();
            $('#hdn-thumb-width').val();
            $('#hdn-thumb-height').val();
            $('#action').val();
            $('#photos_submit').hide();
            setTimeout(function() { 
                clearMsg();
            }, 3000);
        }
        
        function clearMsg() {
            $('#modal_response_div').html();
            $('#modal_response_div').hide();
        }
        
        $(document).on('click', '.submitRequest', function() {
            var record_id = this.value;
            bootbox.confirm('Are you sure you want to submit?', function(result){ 
                if(result) {
                var data = {record_id: record_id};
                    //ajax call
                    $.post('submit-request', data, function (response) {
                        window.location = 'index';
                    });
                }
            });
        });
        
        $(document).on('click', '.pop_kyc', function() {
            var path = $(this).find('img').attr('src');
            var new_path = path.replace('/thumbs', '');
            $('.imagepreview').attr('src', new_path);
            $('#imagemodal').modal('show');   
        });
        
    });
");
?>

<!--
$('#photos_file').on('change', function() {
            readURL(this);
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_preview')
                        .attr('src', e.target.result).width('800px');
                };

                reader.readAsDataURL(input.files[0]);
                //setCrop();
            }
        }
        function setCrop() {
            var image = document.getElementById('img_preview');
            cropper = new Cropper(image);
        }
-->