<?php

namespace app\modules\announcements;

use Yii;
use yii\base\Module as BaseModule;
use yii\web\Application;

/**
 * Description of Administration
 *
 * @author prashant
 */
class Module extends BaseModule {

    public function init() {
        parent::init();
        if (Yii::$app instanceof Application) {
            $this->controllerNamespace = 'app\modules\announcements\controllers';
        }
    }

}
