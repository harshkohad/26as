<?php

/**
 * Developer: Mahesh Solanki
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\icm\models\IcmDashboard;

$jobDateWise = IcmDashboard::getDateWiseJobData($model->date);
$auditDateWise = IcmDashboard::getDateWiseAuditData($model->date);
$overallData = IcmDashboard::getOverAllData();
$auditOverallData = IcmDashboard::getAuditOverAllData();
$passed = $overallData['passed'];
$failed = $overallData['failed'];
$inQueued = $overallData['in_queue'];
$aPassed = $auditOverallData['passed'];
$aFailed = $auditOverallData['failed'];
$aInQueued = $auditOverallData['in_queue'];
?>
<div class="tilesCode">
    <div class="row">
        <div class="col-sm-6">
            <div class="text-center lab-box-style">
                <h2 class="lab-inner-title">Job</h2>
                <div class="lab-donut" id="job" data-total="<?php echo!empty(IcmDashboard::getTotalJob($model->date)) ? IcmDashboard::getTotalJob($model->date) : "Not Found"; ?>"></div>
                <ul class="lab-donut-list" data-pie-id="job" data-options='{"donut":"true", "donut_inner_ratio":"0.82", "percent_offset": "0"}'>
                    <li class="lab-passed" data-value="<?= $jobDateWise['passed'] ?>"><strong>Passed</strong><span><?= $jobDateWise['passed'] ?></span></li>
                    <li class="lab-in-process" data-value="<?= $jobDateWise['in_queue'] ?>"><strong>In Process</strong><span><?= $jobDateWise['in_queue'] ?></span></li>
                    <li class="lab-failed" data-value="<?= $jobDateWise['failed'] ?>"><strong>Failed</strong><span><?= $jobDateWise['failed'] ?></span></li>
                </ul>
                <h2 class="lab-inner-title lab-overall">Job Overall Performance</h2>
                <ul class="lab-performance-list">
                    <li class="lab-passed"><span><?= $passed ?></span><strong>Passed</strong></li>
                    <li class="lab-in-process"><strong><span><?= $inQueued ?></span>In Process</strong></li>
                    <li class="lab-failed"><span><?= $failed ?></span><strong>Failed</strong></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="text-center lab-box-style">
                <h2 class="lab-inner-title">Audit Processing</h2>
                <div class="lab-donut" id="audit" data-total="<?php echo!empty(IcmDashboard::getAuditTotalJob($model->date)) ? IcmDashboard::getAuditTotalJob($model->date) : "Not Found"; ?>"></div>
                <ul class="lab-donut-list" data-pie-id="audit" data-options='{"donut":"true", "donut_inner_ratio":"0.82", "percent_offset": "0"}'>
                    <li class="lab-passed" data-value="<?= $auditDateWise['passed'] ?>"><strong>Passed</strong><span><?= $auditDateWise['passed'] ?></span></li>
                    <li class="lab-in-process" data-value="<?= $auditDateWise['passed'] ?>"><strong>In Process</strong><span><?= $auditDateWise['passed'] ?></span></li>
                    <li class="lab-failed" data-value="<?= $auditDateWise['passed'] ?>"><strong>Failed</strong><span><?= $auditDateWise['passed'] ?></span></li>
                </ul>
                <h2 class="lab-inner-title lab-overall">Job Overall Performance</h2>
                <ul class="lab-performance-list">
                    <li class="lab-passed"><span><?= $aPassed ?></span><strong>Passed</strong></li>
                    <li class="lab-in-process"><strong><span><?= $aInQueued ?></span>In Process</strong></li>
                    <li class="lab-failed"><span><?= $aFailed ?></span><strong>Failed</strong></li>
                </ul>
            </div>
        </div>
    </div>
</div>