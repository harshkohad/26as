<?php

namespace app\components;

use yii\base\InvalidConfigException;
use Yii;
use yii\mongodb\Connection;
use yii\mongodb\Exception;

/**
 * Description of MongoSSL
 *
 * @author shriram
 */
class MongoSSL extends Connection {

    public $otherOptions = [];

    /**
     * Establishes a Mongo connection.
     * It does nothing if a Mongo connection has already been established.
     * @throws Exception if connection fails
     */
    public function open() {
        if ($this->mongoClient === null) {
            if (empty($this->dsn)) {
                throw new InvalidConfigException($this->className() . '::dsn cannot be empty.');
            }
            $token = 'Opening MongoDB connection: ' . $this->dsn;
            try {
                Yii::trace($token, __METHOD__);
                Yii::beginProfile($token, __METHOD__);
                $options = $this->options;
                $options['connect'] = true;
                if ($this->defaultDatabaseName !== null) {
                    $options['db'] = $this->defaultDatabaseName;
                }
                $this->mongoClient = new \MongoClient($this->dsn, $options, $this->otherOptions);
                $this->initConnection();
                Yii::endProfile($token, __METHOD__);
            } catch (\Exception $e) {
                Yii::endProfile($token, __METHOD__);
                throw new Exception($e->getMessage(), (int) $e->getCode(), $e);
            }
        }
    }

}
