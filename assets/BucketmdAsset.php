<?php
namespace app\assets;

use yii\base\Exception;
use yii\web\AssetBundle;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class BucketmdAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bucket-md/assets';
    public $css = [
        'css/style.css',
        'css/bucket-ico-fonts.css',
        'css/style-responsive.css',
        'css/clndr.css',
        'css/bootstrap-reset.css',
    ];
    public $js = [
        'js/scripts.js',
        'js/jquery-ui/jquery-ui-1.10.1.custom.min.js',
        'js/jquery.dcjqaccordion.2.7.js',
        'js/jquery.scrollTo.min.js',
        'js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js',
        'js/jquery.nicescroll.js',
        'js/bootbox.min.js',
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
}
