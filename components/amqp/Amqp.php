<?php

namespace app\components\amqp;

use yii\base\Component;
use yii\base\Exception;
use yii\helpers\Json;
use AMQPConnection;
use AMQPChannel;
use AMQPQueue;
use AMQPExchange;
use AMQPEnvelope;

/**
 * AMQP wrapper for sending / receiving messages to/from exchange.
 * 
 * @author pratik
 */
class Amqp extends Component {

    const TYPE_TOPIC = 'topic';
    const TYPE_DIRECT = 'direct';
    const TYPE_HEADERS = 'headers';
    const TYPE_FANOUT = 'fanout';

    /**
     * @var AMQPConnection
     */
    protected static $ampqConnection;

    /**
     * @var AMQPChannel
     */
    protected $channel;

    /**
     * @var AMQPExchange
     */
    protected $exchange;

    /**
     * @var AMQPQueue 
     */
    protected $queue;

    /**
     * @var string
     */
    public $host = '127.0.0.1';

    /**
     * @var integer
     */
    public $port = 5672;

    /**
     * @var string
     */
    public $user;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $vhost = '/';
    
    /**
     * @var integer
     */
    public $apiPort = 15672;

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        if (empty($this->user)) {
            throw new Exception("Parameter 'user' was not set for AMQP connection.");
        }
        if (empty(self::$ampqConnection)) {
            $connection = new AMQPConnection();
            $connection->setHost($this->host);
            $connection->setPort($this->port);
            $connection->setLogin($this->user);
            $connection->setPassword($this->password);
            $connection->setVhost($this->vhost);
            $connection->connect();
            if (!$connection->isConnected()) {
                throw new Exception('AMQP connection failed.');
            }
            self::$ampqConnection = $connection;
        }
    }

    /**
     * Returns AMQP connection.
     *
     * @return AMQPConnection
     */
    public function getConnection() {
        return self::$ampqConnection;
    }

    /**
     * Returns AMQP connection.
     *
     * @return AMQPChannel
     */
    public function getChannel() {
        if (!$this->channel) {
            $this->channel = new AMQPChannel($this->getConnection());
        }
        return $this->channel;
    }

    /**
     * Declare AMQPExchange 
     * 
     * @param string $exchange_name
     * @param string $exchange_type
     * @param string $flags AMQP_DURABLE
     * @return app\components\amqp\amqp
     */
    public function declareExchange($exchange_name, $exchange_type = self::TYPE_DIRECT, $flags = AMQP_DURABLE) {
        $this->exchange = new AMQPExchange($this->getChannel());
        $this->exchange->setName($exchange_name);
        $this->exchange->setType($exchange_type);
        $this->exchange->setFlags($flags);
        $this->exchange->declare();
        return $this;
    }

    /**
     * Returns declared AMQPExchange
     * 
     * @return AMQPExchange
     */
    public function getExchange() {
        return $this->exchange;
    }

    /**
     * Declares Queue 
     * 
     * @param string $queue
     * @param string $routing_key
     * @param string $flags AMQP_EXCLUSIVE
     * @param array $arguments
     * @return \app\components\amqp\Amqp
     */
    public function declareQueue($queue, $routing_key, $flags = null, $arguments = []) {
        $this->queue = new AMQPQueue($this->getChannel());
        if ($queue)
            $this->queue->setName($queue);
        if ($arguments)
            $this->queue->setArguments($arguments);
        if ($flags)
            $this->queue->setFlags($flags);
        $this->queue->declare();
        $this->queue->bind($this->exchange->getName(), $routing_key);
        return $this;
    }

    /**
     * Returns AMQPQueue
     * 
     * @return AMQPQueue
     */
    public function getQueue() {
        return $this->queue;
    }

    /**
     * Publish message to the exchange.
     *
     * @param string $routing_key
     * @param string|array $message
     * @return boolean
     */
    public function publish($routing_key, $message) {
        $message = $this->prepareMessage($message);
        $isPublished = $this->getExchange()->publish($message, $routing_key);
        return $isPublished;
    }

    /**
     * Listens the exchange for messages.
     *
     * @param callable $callback
     * @param string $flags
     */
    public function listen($callback, $flags = AMQP_NOPARAM) {
        $this->getQueue()->consume($callback, $flags);
        $this->getConnection()->disconnect();
    }

    /**
     * Returns prepaired AMQP message.
     *
     * @param string|array|object $message
     * @return AMQPEnvelope
     * @throws Exception If message is empty.
     */
    public function prepareMessage($message) {
        if (empty($message)) {
            throw new Exception('AMQP message can not be empty');
        }
        if (is_array($message) || is_object($message)) {
            $message = Json::encode($message);
        }
        return $message;
    }

}
