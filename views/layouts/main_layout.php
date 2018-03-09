<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

app\assets\BucketmdAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/bucket-md/assets');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset=""<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Harshwardhan Kohad">
        <link rel="shortcut icon" href="<?PHP echo Yii::$app->request->baseUrl;?>/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?PHP echo Yii::$app->request->baseUrl;?>/images/favicon.ico" type="image/x-icon">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

    </head>
    <body>
        <section id="container">
            <?=
            $this->render(
                    'header.php', ['directoryAsset' => $directoryAsset]
            )
            ?>

            <?=
            $this->render(
                    'left.php', ['directoryAsset' => $directoryAsset]
            )
            ?>

            <?=
            $this->render(
                    'content.php', ['content' => $content, 'directoryAsset' => $directoryAsset]
            )
            ?>

        </section>
        <?php   $this->endBody();  ?>
    </body>
</html>
<?php $this->endPage() ?>
