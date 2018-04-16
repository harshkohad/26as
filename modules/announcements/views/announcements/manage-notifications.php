<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\ApplicantProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Announcements';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading wht-bg" style="background: #fff !important; border-bottom: none !important;">
                    <?php
                    $j = 0;
                    if (!empty($data)) {
                        $j = count($data);
                    }
                    ?>
                <h4 class="gen-case">Manage <?= $label; ?> (<?= $j ?>)</h4>
                </header>
                <div class="panel-body minimal">
                    <div class="table-inbox-wrap ">
                        <table class="table table-inbox table-hover">
                            <tbody>
                                <?php
                                if (!empty($data)) {
                                    $i = 1;
                                    ?>
                                    <tr class="unread">
                                        <th>Sr No.</th>
                                        <th><?= $label; ?></th>
                                        <th class="view-message  text-right">Time</th>
                                    </tr><?php
                                    foreach ($data as $dataDtl) {
                                        ?>

                                        <tr>
                                            <!--<td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>-->
                                            <td class="inbox-small-cells"><?= $i ?></i></td>
                                            <td class="view-message"><?= $dataDtl['message'] ?></td>
                                            <td class="view-message  text-right"><?= $dataDtl['created_on'] ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                } else {
                                    ?>
                                <td class="view-message  dont-show">No Data Found</td>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
