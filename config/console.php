<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$mongodb = require(__DIR__ . '/mongodb.php');
$db2 = require(__DIR__ . '/db2.php');
$amqp = require(__DIR__ . '/amqp.php');

$modules = require(__DIR__ . '/modules.php');

//require (dirname(__DIR__) . '/vendor/Net_Nmap/Net/Nmap.php');


$modules['gii'] = 'yii\gii\Module';
$modules['encrypter'] = 'nickcv\encrypter\Module';

return [
    'id' => 'anant-networks-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii', 'encrypter'],
    'controllerNamespace' => 'app\commands',
    'modules' => $modules,
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'class' => 'yii\web\User',
//            'enableAutoLogin' => true,
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'sessionTable' => 'tbl_session',
        ],
        'db' => $db,
        'db2' => $db2,
        'mongodb' => $mongodb,
        'amqp' => $amqp,
        'encrypter' => require(__DIR__ . DIRECTORY_SEPARATOR . 'encrypter.php'),
        'net' => [
            'class' => 'app\components\network\NetworkAdaptor',
        ],
        'commonUtility' => [
            'class' => 'app\components\CommonUtility',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest_user']
        ],
        'mutex' => [
            'class' => 'yii\mutex\FileMutex'
        ],
    ],
    'params' => $params,
    'controllerMap' => [
        'mongodb-migrate' => 'yii\mongodb\console\controllers\MigrateController',
    ],
    'aliases' => [
        '@mdm/admin' => '@app/extensions/mdm/yii2-admin',
    ],
];
