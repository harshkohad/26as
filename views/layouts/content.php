<?php

use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">        
        <section class="panel">
            <header class="panel-heading">
                <?php if (isset($this->blocks['content-header'])) { ?>
                    <?= $this->blocks['content-header'] ?>
                <?php
                } else {
                    if ($this->title !== null) {
                        echo \yii\helpers\Html::encode($this->title);
                    } else {
                        echo \yii\helpers\Inflector::camel2words(
                                \yii\helpers\Inflector::id2camel($this->context->module->id)
                        );
                        echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                    }
                }
                ?>
                <span class="tools pull-right">
                    <?=
                        Breadcrumbs::widget(
                            [
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]
                        )
                    ?>
                </span>
            </header>
<!--            <div class="panel-body">
                
            </div>-->
        </section>
        <?= Alert::widget() ?>
        <?= $content  ?>
    </section>
</section>