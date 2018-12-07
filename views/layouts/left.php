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
                        //include \Yii::$app->basePath . '/config/menu/Test.php',
//                        include \Yii::$app->basePath . '/config/menu/Applications.php',
//                        include \Yii::$app->basePath . '/config/menu/GenerateMis.php',
//                        include \Yii::$app->basePath . '/config/menu/ManageMobileApp.php',
//                        include \Yii::$app->basePath . '/config/menu/Announcements.php',
                        include \Yii::$app->basePath . '/config/menu/Settings.php',
                        //include \Yii::$app->basePath . '/config/menu/UserProfile.php',
                    ]
                ])
            ?>
             <!--id="nav-accordion"-->
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->