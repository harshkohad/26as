<?php
use yii\helpers\Html;
use yii\helpers\Url;

use app\components\widgets\LeftMenuWidget;
use app\components\widgets\TopMenuWidget;
use mdm\admin\components\Helper;
?>

<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <?= bucketmd\BMenu::widget(
                [
                    'options' => ['class' => 'sidebar-menu', 'id' => 'nav-accordion'],
                    'items' => [
                        include \Yii::$app->basePath . '/config/menu/Home.php',
                        include \Yii::$app->basePath . '/config/menu/Request.php',
                        include \Yii::$app->basePath . '/config/menu/Process.php',
                        include \Yii::$app->basePath . '/config/menu/Settings.php',
                    ]
                ])
            ?>
             <!--id="nav-accordion"-->
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->