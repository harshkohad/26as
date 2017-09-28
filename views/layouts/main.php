<?php
/* @var $this View */
/* @var $content string */

use app\assets\AppAsset;
use app\components\widgets\TopMenuWidget;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\Alert;

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
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            echo TopMenuWidget::widget();
            ?>
            <div class="container">                
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

    <footer class="footer">
        <div class="container">
            <!--<p class="pull-left">&copy; My Company <//?= date('Y') ?></p>-->

<!--                <p class="pull-right"><//?= Yii::powered() ?></p>-->
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
