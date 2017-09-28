<?php
namespace app\components\widgets\assets;
use yii\web\AssetBundle;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModalWidgetAssets
 *
 * @author shriram
 */

Class ModalWidgetAssets extends AssetBundle {

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];

}