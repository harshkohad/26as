<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\ApplicantProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Applicant Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
        <div class="col-sm-9">
            <section class="panel">
                <header class="panel-heading wht-bg">
                    <h4 class="gen-case">Manage <?= $label; ?></h4>
                </header>
                <div class="panel-body minimal">
                    <div class="table-inbox-wrap ">
                        <table class="table table-inbox table-hover">
                            <tbody>
                                <?php
                                if (!empty($data)) {
                                    ?>
                                    <tr class="unread">
                                        <th></th>
                                        <th><?= $label; ?></th>
                                        <th class="view-message  text-right">Time</th>
                                    </tr><?php
                                    foreach ($data as $dataDtl) {
                                        ?>

                                        <tr>
                                            <td class="inbox-small-cells"><i class="fa fa-star inbox-started"></i></td>
                                            <td class="view-message"><?= $dataDtl['message'] ?></td>
                                            <td class="view-message  text-right"><?= $dataDtl['created_on'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                <td class="view-message  dont-show">No Data Found</td>
                                <?php
                            }
                            ?>
<!--                            <tr class="unread">

            <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
            <td class="view-message  dont-show"><a href="mail_view.html">ABC Company</a></td>
            <td class="view-message "><a href="mail_view.html">Lorem ipsum dolor imit set.</a></td>
            <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
            <td class="view-message  text-right">12.10 AM</td>
        </tr>-->
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>


    </div>
</section>
