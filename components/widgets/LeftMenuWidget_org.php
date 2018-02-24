<?php

namespace app\components\widgets;

use kartik\sidenav\SideNav;
use Yii;
use yii\base\Widget;
use app\components\custom\LeftSideNav;

/**
 * LeftMenuWidget - Prepare and render left menu
 *
 * @author Mahesh Solanki
 */
class LeftMenuWidget extends Widget {

    /**
     * Menu Items
     * 
     * @var [] 
     */
    public static $menuItems = [];
    public $leftMenuGroup;

    public function init() {
        parent::init();
        $this->loadMenuItems();
    }

    public function run() {
        echo LeftSideNav::widget([
//            'type' => SideNav::TYPE_INFO,
            'heading' => isset(self::$menuItems[$this->leftMenuGroup]['heading']) ? self::$menuItems[$this->leftMenuGroup]['heading'] : '',
//            'options' => ['class' => ''],
            'items' => isset(self::$menuItems[$this->leftMenuGroup]['items']) ? self::$menuItems[$this->leftMenuGroup]['items'] : [],
            'activateParents' => TRUE,
            'encodeLabels' => false,
            'headingOptions' => ['class' => 'lab-sidebar-header text-capitalize'],
        ]);
    }

    public function loadMenuItems() {
        $this->leftMenuGroup = isset(Yii::$app->controller->view->params['left-menu-group']) ? Yii::$app->controller->view->params['left-menu-group'] : '';
        $this->setLeftMenuItems();
    }

    protected function setLeftMenuItems() {
        foreach (self::getDefaultMenus() as $menuGroup => $menu) {
            self::registerMenu($menuGroup, $menu);
        }
    }

    /**
     * Register Menu Items
     * 
     * @param string $menuGroup
     * @param array $menu
     */
    public static function registerMenu($menuGroup, $menu = []) {
        if (isset($menu['heading']) && isset($menu['items']) && is_array($menu['items'])) {
            self::$menuItems[$menuGroup] = $menu;
        }
    }

    /**
     * Remove Menu
     * 
     * @param string $menuGroup
     */
    public static function unregisterMenu($menuGroup) {
        if (isset(self::$menuItems[$menuGroup])) {
            unset(self::$menuItems[$menuGroup]);
        }
    }

    /**
     * Get Core Default Menus
     * 
     * @return array
     */
    public static function getDefaultMenus() {
        return [
            "settings" => [
                'heading' => 'Settings',
                'items' => [
                    [
                        'label' => '<i class="fa fa-check" aria-hidden="true"></i> <span>Credential Management</span>',
                        'options' => ['class' => 'treeview'],
                        'items' => [
                            ['label' => '<i class="fa fa-circle-o" aria-hidden="true"></i> <span>Device Credentials</span>', 'url' => ['/device-credentials/index']]
                        ],
                    ],
                    [
                        'label' => '<i class="fa fa-check" aria-hidden="true"></i> <span>User Management</span>',
                        'options' => ['class' => 'treeview'],
                        'items' => [
                            ['label' => '<i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Users</span>', 'url' => ['/admin/user/index']],
                        ],
                    ],
                    [
                        'label' => '<i class="fa fa-check" aria-hidden="true"></i> <span>Access Management</span>',
                        'options' => ['class' => 'treeview'],
                        'items' => [
                            ['label' => '<i class="fa fa-circle-o" aria-hidden="true"></i> <span>Role Assignment</span>', 'url' => ['/admin/assignment/index']],
                            ['label' => '<i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Roles</span>', 'url' => ['/admin/role/index']],
                            ['label' => '<i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Permissions</span>', 'url' => ['/admin/permission/index']],
                        ],
                    ],
                    [
                        'label' => '<i class="fa fa-check" aria-hidden="true"></i> <span>Advanced Settings</span>',
                        'options' => ['class' => 'treeview'],
                        'items' => [
                            ['label' => '<i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Routes</span>', 'url' => ['/admin/route/index']],
                            ['label' => '<i class="fa fa-circle-o" aria-hidden="true"></i> <span>Manage Rabbitmq</span>', 'url' => ['/administration/rabbitmq-management/queue']],
                        ],
                    ],
                ]
            ]
        ];
    }

}
