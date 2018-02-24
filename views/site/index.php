<?php
/* @var $this View */

use app\modules\icm\models\IcmDashboard;
use yii\web\View;

$this->title = 'Dashboard';
$this->registerJsFile(Yii::$app->view->theme->baseUrl . "/js/vendors/dependencies.js");
$this->registerJsFile(Yii::$app->view->theme->baseUrl . "/js/vendors/chart.min.js");
$this->registerJsFile(Yii::$app->view->theme->baseUrl . "/js/vendors/hicharts/highcharts.js");

$overallData = IcmDashboard::getOverAllData();
$auditOverallData = IcmDashboard::getAuditOverAllData();
?>
<div class="container-fluid text-center">
    <h2 class="margin-bottom-0">Network Discovery</h2><span class="dashboard-icon"><i class="fa fa-globe"></i></span><br />
    <?php echo $this->render('@app/modules/networkDiscovery/views/dashboard/overall_summary', ['model' => $discoveryDashboardModel]); ?>
</div>
<div class="container-fluid text-center">
    <h2 class="margin-bottom-0">Inventory</h2><span class="dashboard-icon"><i class="fa fa-refresh"></i></span><br />
    <?php echo $this->render('@app/modules/networkDiscovery/views/inventory-dashboard/home_dashboard', ['model' => $inventoryDashboardModel]); ?>
</div>
<div class="container-fluid text-center">
    <h2 class="margin-bottom-0">ICM</h2><span class="dashboard-icon"><i class="fa fa-cog"></i></span><br />
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading text-left">
                    <h3 class="panel-title">Configuration Jobs</h3>
                </div>
                <div class="panel-body">
                    <div class="lab-donut" id="job" data-total="<?php echo!empty($overallData['total_count']) ? $overallData['total_count'] : "No Data"; ?>"></div>
                    <ul class="lab-donut-list" data-pie-id="job" data-options='{"donut":"true", "donut_inner_ratio":"0.82", "percent_offset": "0"}'>
                        <li class="lab-passed" data-value="<?= $overallData['passed'] ?>"><strong>Passed</strong><span><?= $overallData['passed'] ?></span></li>
                        <li class="lab-in-process" data-value="<?= $overallData['in_queue'] ?>"><strong>In Process</strong><span><?= $overallData['in_queue'] ?></span></li>
                        <li class="lab-failed" data-value="<?= $overallData['failed'] ?>"><strong>Failed</strong><span><?= $overallData['failed'] ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading text-left">
                    <h3 class="panel-title">Compliance Jobs</h3>
                </div>
                <div class="panel-body">
                    <div class="lab-donut" id="audit" data-total="<?php echo!empty($auditOverallData['total_count']) ? $auditOverallData['total_count'] : "No Data"; ?>"></div>
                    <ul class="lab-donut-list" data-pie-id="audit" data-options='{"donut":"true", "donut_inner_ratio":"0.82", "percent_offset": "0"}'>
                        <li class="lab-passed" data-value="<?= $auditOverallData['passed'] ?>"><strong>Passed</strong><span><?= $auditOverallData['passed'] ?></span></li>
                        <li class="lab-in-process" data-value="<?= $auditOverallData['in_queue'] ?>"><strong>In Process</strong><span><?= $auditOverallData['in_queue'] ?></span></li>
                        <li class="lab-failed" data-value="<?= $auditOverallData['failed'] ?>"><strong>Failed</strong><span><?= $auditOverallData['failed'] ?></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(window).load(function () {
        Pizza.init();
        loadModelChart();
        loadSoftwareDetailsChart();
        loadSoftwareVersionsChart();
    });
</script>