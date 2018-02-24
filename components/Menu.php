<?php
namespace app\components;

use app\components\widgets\LeftMenuWidget;
use Yii;
use yii\base\Component;


/**
 * Menu Component
 * This class is responsible for registering all modules menus
 * @author pratik
 */
class Menu extends Component {

    public function init() {
        parent::init();
        $this->registerLeftMenus();
    }

    public function registerLeftMenus() {
        foreach (Yii::$app->getModules() as $module) {
            if (method_exists($module['class'], 'getDefaultMenu')) {
                foreach ($module['class']::getDefaultMenu() as $menuGroup => $menu) {
                    LeftMenuWidget::registerMenu($menuGroup, $menu);
                }
            }
        }
    }

}
