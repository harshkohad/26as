<?php

namespace app\components\custom;

use yii\base\Exception;

/**
 * Description of GlobalException
 *
 * @author ShriRam
 */
class NamedException extends Exception {

    public $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

}
