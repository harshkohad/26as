<?php
/* @var $this View */
/* @var $content string */

use \app\assets\AdminLteFullPage;
use app\components\widgets\TopMenuWidget;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\web\View;
use app\components\widgets\ModalFormWidget;

AdminLteFullPage::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">-->
        <link rel="icon" href="<?php echo \yii\helpers\Url::to(Yii::$app->view->theme->baseUrl . '/images/favicon.png') ?>" type="image/png">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/css/bootstrap/bootstrap.min.css" />-->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/css/box-style.css" />-->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/css/lab/fonts.css" />-->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/css/lab/font-awesome.min.css" />-->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/css/lab/custom.css" />-->
        <script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/vendors/jquery.min.js"></script>
        <script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/js/vendors/custom.js"></script>
    </head>
    <body class="hold-transition sidebar-mini skin-purple-light">
        <div class="loading hide">Loading&#8230;</div>
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="" class="logo">
                    <!--<span class="logo-mini"><b></b></span>
                    <span class="logo-lg"><b>CISCO</b></span>-->
                </a>

                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle hidden" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="top-navmenu jsTopMenu">
                        <?php echo TopMenuWidget::widget(); ?>
                    </div>
                    <i class="fa fa-navicon topmenunavicon jsToggleTopNav"></i>
                </nav>
            </header>
            <div class="full-content-wrapper jsContentWrp">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
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
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
            <div class="clearfix"></div>
            <footer class="lab-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 lab-copyright">
                            <!--<p>&copy;<?= date('Y') ?> <a target="_blank" href="#">CISCO</a>All Rights Reserved</p>-->
                        </div>
                        <div class="col-sm-6 text-right">
                            <nav class="lab-footer-menu"><p>Powered by <a target="_blank" href="http://infinitylabs.in">InfinityLabs. </a></p>
                                <!-- <?php
                                echo ModalFormWidget::widget([
                                    'modal_id' => 'create-privacy-statement',
                                    'triggerHeader' => 'Privacy Policy',
                                    'containerOptions' => ['class' => 'text-left'],
                                    'triggerOptions' => ['class' => 'btn btn-link'],
                                    'renderContent' => $this->render("//site/termsandconditions"),
                                    'header' => 'Privacy Policy',
                                ]);
                                ?>-->
                                 <!--<?//= Html::a('Terms & Conditions | Privacy Policy', ['//site/terms-and-conditions'], []) ?>-->
                            </nav>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <?php $this->endBody() ?>
        <script type="text/javascript">
            $(document).ajaxSend(function () {
                //$('.loading').removeClass('hide');
            });
            $(document).ajaxComplete(function () {
                //$('.loading').addClass('hide');
            });
            $(document).ajaxError(function (event, xhr) {
                console.log(xhr.responseText);
            });
        </script>

    </body>
</html>
<?php $this->endPage() ?>
