<?php
/* @var $this View */
/* @var $content string */

use app\assets\AdminLteLogin;
use app\components\widgets\TopMenuWidget;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\Alert;

AdminLteLogin::register($this);
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
    </head>
    <body class="hold-transition login-page sidebar-mini skin-purple-light">
        <?php $this->beginBody() ?>

        <?php
        // echo TopMenuWidget::widget();
        ?>

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
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
