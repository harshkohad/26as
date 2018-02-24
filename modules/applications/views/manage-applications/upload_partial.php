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
        'Aadhaar Card No',
        'Pan Card No',
        'Mobile No',
        'Applicant Type',
        'Profile Type',
        'Date Of Application',
        'Residence Address',
        'Residence Pincode',
        'Residence Triggers',
        'Residence Send for verification',
        'Office Address','Office Pincode',
        'Office Triggers',
        'Office Send for verification',
        'Business Address',
        'Business Pincode',
        'Business Triggers',
        'Business Send for verification',
        'NOC Address',
        'NOC Pincode',
        'NOC Triggers',
        'NOC Send for verification'
    ],
]); ?>