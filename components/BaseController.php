<?php

/**
 * Developer: Mahesh Solanki
 */

namespace app\components;

use Yii;
use yii\web\Controller;

class BaseController extends Controller {

    public $leftMenuGroup;

    public function beforeAction($action) {
        $result = parent::beforeAction($action);
        Yii::$app->controller->view->params['left-menu-group'] = $this->leftMenuGroup;
        return $result;
    }

}
