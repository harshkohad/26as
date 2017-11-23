<?php

//use backend\assets\AppAsset;
use yii\helpers\Html;
use app\assets\AdminLteLogin;

/* @var $this \yii\web\View */
/* @var $content string */

AdminLteLogin::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link href="<?= Yii::$app->view->theme->baseUrl;?>/css/custom-skin.css" rel="stylesheet">  
    </head>
    <body class="hold-transition login-page sidebar-mini" style="background-image: url('../images/login_bg.png');">

        <?php $this->beginBody() ?>
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
