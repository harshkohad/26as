<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'Sr',
        'First Name',
        'Middle Name',
        'Last Name',
        'Date Of Birth',
        'Aadhaar Card No',
        'Pan Card No',
        'Mobile No',
        'Alternate Contact No',
        'Company Name',
        'Address',
        'Case Id',
        'Branch Name',
        'Applicant Type',
        'Profile Type',
        'Date Of Application',
        'Residence Address',
        'Residence Pincode',
        'Residence Triggers',
        'Residence Send for verification',
        'Office Address',
        'Office Pincode',
        'Office Triggers',
        'Office Send for verification',
        'Business Address',
        'Business Pincode',
        'Business Triggers',
        'Business Send for verification',
        'Resi/Office Address',
        'Resi/Office Pincode',
        'Resi/Office Triggers',
        'Resi/Office Send for verification',
        'Builder Profile Address',
        'Builder Profile Pincode',
        'Builder Profile Triggers',
        'Builder Profile Send for verification',
        'Property(APF) Address',
        'Property(APF) Pincode',
        'Property(APF) Triggers',
        'Property(APF) Send for verification',
        'Individual Property Address',
        'Individual Property Pincode',
        'Individual Property Triggers',
        'Individual Property Send for verification',
        'NOC (Society) Address',
        'NOC (Society) Pincode',
        'NOC (Society) Triggers',
        'NOC (Society) Send for verification',
        'NOC (Business/Conditional) Address',
        'NOC (Business/Conditional) Pincode',
        'NOC (Business/Conditional) Triggers',
        'NOC (Business/Conditional) Send for verification',
        [
            'attribute' => 'Dedupe Check',
            'label' => 'Dedupe Check',
            'format' => 'raw',
        ],
    ],
]);

yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'header' => '<h4><i class="text-white fa fa-binoculars"></i> Search Applicant Profiles</h4>',
    'id' => 'profile_modal',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
echo "<div id='modalContent'><div style='text-align:center'><img src='" . Yii::$app->request->BaseUrl . "/images/acs_loader.gif'></div></div>";
yii\bootstrap\Modal::end();


//$this->registerJs("
//        $(function(){   
//            function getForm(first_name, middle_name, last_name) {
//                alert('asdasdsa');return false;
//                var form_data = $('#search_profile').serialize();
//                var url = '" . yii\helpers\Url::to(["manage-applications/get-applicant-profile"]) . "';
//                $('#profile_modal').modal('show');
//                $.post('get-applicant-profile?first_name=first_name&middle_name=middle_name&last_name=last_name&isAjaxCall=1', {'data': ''}, function (response) {
//                    $('#modalContent').html(response);
//                });
//            } 
//        });
//    ");
?>


<script>//
//
    function getDedupeModal(first_name, middle_name, last_name, pan_card, mobile_no, aadhar_card, id) {
        var url = '<?php echo yii\helpers\Url::to(["manage-applications/get-applicant-profile"]); ?>'
        $('#profile_modal').modal('show');
        var dataString = "inputFirstName=" + first_name + "&inputMiddleName=" + middle_name + "&inputLastName=" + last_name + "&inputMobileNumber=" + mobile_no + "&inputPanCard=" + pan_card + "&inputAadhaarCard=" + aadhar_card + "&id=" + id + "&isAjaxCall=1";
        $.ajax({
            url: url, // Url to which the request is send
            type: 'POST', // Type of request to be send, called as method
            data: dataString, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            success: function (response)   // A function to be called if request succeeds
            {
                $('#modalContent').html(response);
            }
        });
        $(document).on('click', '.btn_select_record', function () {
            var value = $(this).val();
            var dest = $(this).attr('rel');
            var id = $(this).attr('id');
            $("#profile_id_" + id).val(value);
            $("#profile_name_" + id).html(dest);
            $('#profile_modal').modal('hide');
//            document.getElementById("profile_id_" + dest).value = value;
        });

    }
//</script>