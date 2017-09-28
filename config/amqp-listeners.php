<?php

/**
 * AMQP Listeners
 */
return [
    'class' => 'webtoucher\amqp\controllers\AmqpListenerController',
    'interpreters' => [
        //'my-exchange' => 'app\components\RabbitInterpreter', // interpreters for each exchange
    ],
    'exchange' => 'default-exchange', // default exchange
];
