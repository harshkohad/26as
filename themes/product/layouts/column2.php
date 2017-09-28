<?php

use app\components\widgets\LeftMenuWidget;

$this->beginContent('@app/themes/product/layouts/main.php');
?>
<div>
    <div class="lab-panel-wrapper">
        <div class="lab-panel-sidebar">
            <?php
            echo LeftMenuWidget::widget();
            ?>
        </div>
        <div class="lab-panel-content">
            <div class="tab-content">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endContent(); ?>