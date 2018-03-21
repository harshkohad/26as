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
<?= GridView::widget([
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
        'NOC (Business/Conditional) Send for verification'
    ],
]); ?>