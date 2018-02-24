<?php

namespace app\commands;

use app\modules\icm\models\IcmTask;

/**
 * AuditAmqpController
 * 
 * This class demonstrates AMQP publisher and consumer. 
 * 
 * Sample usage-
 *  
 * AuditConsume command (run in new terminal2) - ./yiic audit-amqp/audit-consume
 * 
 * @author Mahesh Solanki
 */
class AuditAmqpController extends \yii\console\Controller {

    /**
     * Consume messages from exchange
     * 
     */
    public function actionAuditConsume() {
        $callback = function ($envelope, $queue) {
            $data = json_decode($envelope->getBody());
            echo "\nJob Start for ID:" . $data->id . "\n";
            $task = new IcmTask;
            $task->executeTask($data->id);
            echo "\nJob Finished for ID:" . $data->id . "\n";
            usleep(100);
            $queue->ack($envelope->getDeliveryTag());
        };
        \Yii::$app->amqp->declareExchange('audit_ex', \app\components\amqp\Amqp::TYPE_TOPIC)->declareQueue('audit_q', 'audit_process', AMQP_DURABLE)->listen($callback);
        echo "\here";
    }

}
