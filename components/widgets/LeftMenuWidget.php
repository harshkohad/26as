<?php

namespace app\components\widgets;

use mdm\admin\components\Helper;
use Yii;
use yii\base\Widget;
use app\components\widgets\ACSNav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

/**
 * TopMenuWidget - Prepare and render top menu
 *
 * @author pratik
 */
class LeftMenuWidget extends Widget {

    /**
     * Menu Items
     * 
     * @var [] 
     */
    public $items = [];
    public $activateParents = TRUE;

    public function init() {
        parent::init();
        $this->loadMenuItems();
    }

    public function run() {
//        NavBar::begin([
//            'brandLabel' => '',
//            'brandUrl' => Yii::$app->homeUrl,
//            'options' => [
//                'class' => 'navbar-inverse navbar-fixed-top',
//            ],
//        ]);
        echo ACSNav::widget([
            'options' => ['class' => 'sidebar-menu'],
            'items' => $this->items,
            'activateParents' => TRUE,
        ]);
//        NavBar::end();
    }

    protected function loadMenuItems() {
        if (Yii::$app->user->isGuest) {
            $this->setGuestUserMenuItems();
        } else {
            $this->setLoggedInUserMenuItems();
        }
    }

    protected function setLoggedInUserMenuItems() {
        $this->items = [
            include \Yii::$app->basePath . '/config/menu/Home.php',
            include \Yii::$app->basePath . '/config/menu/Test.php',
            include \Yii::$app->basePath . '/config/menu/Settings.php',
            include \Yii::$app->basePath . '/config/menu/UserProfile.php',
        ];
    }

    protected function setGuestUserMenuItems() {
        $this->items = [
                //[ 'label' => 'Login', 'url' => ['/admin/user/login']],
        ];
    }

}
