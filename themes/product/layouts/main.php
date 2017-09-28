<?php
/* @var $this View */
/* @var $content string */

use app\assets\AppAsset;
use app\components\widgets\TopMenuWidget;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\web\View;
use app\components\widgets\ModalFormWidget;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/css/bootstrap/bootstrap.min.css" />
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/css/box-style.css" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/css/lab/fonts.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/css/lab/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/css/lab/custom.css" />
        <script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/vendors/jquery.min.js"></script>
        <script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/vendors/custom.js"></script>
    </head>
    <body>
        <div class="loading hide">Loading&#8230;</div>
        <?php $this->beginBody() ?>

        <div id="main-wrapper" class="container-fluid">
            <!--Header Starts Here-->
            <nav class="navbar lab-navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?php echo Yii::$app->homeUrl; ?>" class="navbar-brand site-logo">
                            <img class="logo" alt="Brand" src="<?php echo \yii\helpers\Url::to(Yii::$app->view->theme->baseUrl . '/images/Logo-small.png') ?>" />
                        </a>
                    </div>
                    <div class="collapse navbar-collapse text-capitalize" id="myNavbar">
                        <?php
                        echo TopMenuWidget::widget();
                        ?>
                    </div>
                </div>
            </nav>
            <!--Header Ends Here-->
            <div>                
                <?php foreach (Yii::$app->session->getAllFlashes() as $key => $message): ?>
                    <?php
                    Alert::begin([
                        'options' => [
                            'class' => 'alert-' . $key,
                        ],
                    ]);
                    ?>
                    <?php if (is_array($message)):
                        ?>
                        <?php foreach ($message as $m): ?>
                            <?php echo $m; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php echo $message; ?>
                    <?php endif; ?>
                    <?php Alert::end(); ?>
                <?php endforeach; ?>
                <?= $content ?>
            </div>

            <!--Footer Starts Here-->
            <footer class="lab-footer">
                
            </footer>
            <!--Footer Ends Here-->
        </div>
        <?php $this->endBody() ?>
        <script type="text/javascript">
            $(document).ajaxSend(function () {
                $('.loading').removeClass('hide');
            });
            $(document).ajaxComplete(function () {
                $('.loading').addClass('hide');
            });
            $(document).ajaxError(function (event, xhr) {
                alert(xhr.responseText);
            });
        </script>
    </body>
</html>
<?php $this->endPage() ?>
