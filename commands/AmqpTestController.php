<?php

namespace app\commands;

/**
 * AmqpTestController
 * 
 * This class demonstrates AMQP publisher and consumer. 
 * 
 * Sample usage-
 * 
 * Publish command (run in new terminal1) - ./yiic amqp-test/publish 
 * Consume command (run in new terminal2) - ./yiic amqp-test/consume
 * 
 * @author pratik
 */
class AmqpTestController extends \yii\console\Controller {

    /**
     * Publish message to exchange
     *  
     * @param type $routing_key
     * @param type $message
     */
    public function actionPublish($routing_key = 'hello_topic_rk', $message = 'Hello') {
        $exchange = \Yii::$app->amqp->declareExchange('hello_topic_ex', \app\components\amqp\Amqp::TYPE_TOPIC);
        $i = 0;
        while (1) {
            $result = $exchange->publish($routing_key, $message . "-" . $i);
            echo "\n" . ($result ? "Published #" . $i : "Failed #" . $i);
            $i++;
        }
    }

    /**
     * Consume messages from exchange
     * 
     */
    public function actionConsume() {
        $callback = function ($envelope, $queue) {
            echo "\nMessage:" . $envelope->getBody();
            usleep(100);
            $queue->ack($envelope->getDeliveryTag());
        };
        \Yii::$app->amqp->declareExchange('hello_topic_ex', \app\components\amqp\Amqp::TYPE_TOPIC)->declareQueue('hello_topic_q', 'hello_topic_rk', AMQP_DURABLE)->listen($callback);
        echo "\here";
    }

}
