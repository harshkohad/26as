<?php

namespace mdm\admin\controllers;

use mdm\admin\components\ItemController;
use yii\rbac\Item;

/**
 * RoleController implements the CRUD actions for AuthItem model.
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class RoleController extends ItemController {

    public $leftMenuGroup = 'settings';
    //public $layout = '//adminlte-default';

    /**
     * @inheritdoc
     */
    public function labels() {
        return[
            'Item' => 'Role',
            'Items' => 'Roles',
        ];
    }

    /**
     * @inheritdoc
     */
    public function getType() {
        return Item::TYPE_ROLE;
    }

}
