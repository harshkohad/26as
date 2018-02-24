<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$db2 = require(__DIR__ . '/db2.php');
$mongodb = require(__DIR__ . '/mongodb.php');
$amqp = require(__DIR__ . '/amqp.php');
$modules = require(__DIR__ . '/modules.php');

$config = [
    'id' => 'hwk-networks',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'menu'],
    'layout' => 'main_layout',
    'components' => [
        'urlManager' => [
            'showScriptName' => FALSE, //!(isset($_GET['url_rewrite']) && $_GET['url_rewrite'] == 1),
            'enablePrettyUrl' => TRUE, // Disable r= routes
//            'enableStrictParsing' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                // Here is the mater configuration of URL Management for Modules
                'api/<module:\w+>/<controller:\w+>/<id:\d+>' => 'api/<module>/<controller>/view',
                'api/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => 'api/<module>/<controller>/<action>',
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fjkdbf4t84ugbvjsif8298gfb',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['admin/user/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'db2' => $db2,
        'mongodb' => $mongodb,
        'session' => [
            'class' => 'yii\web\DbSession',
            'sessionTable' => 'tbl_session',
        ],
        'amqp' => $amqp,
        'encrypter' => require(__DIR__ . DIRECTORY_SEPARATOR . 'encrypter.php'),
        'commonUtility' => [
            'class' => 'app\components\CommonUtility',
        ],
        'IpAddressHelper' => [
            'class' => 'app\components\IpAddressHelper',
        ],
        'net' => [
            'class' => 'app\components\network\NetworkAdaptor',
        ],
        'formatter' => [
            'nullDisplay' => ""
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest_user']
        ],
        'mutex' => [
            'class' => 'yii\mutex\FileMutex'
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/product',
                'baseUrl' => '@web/themes/product',
                'pathMap' => [
                    '@app/views' => '@app/themes/product',
                ],
            ],
        ],
//        'view' => [
//            'theme' => [
//                'pathMap' => [
//                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
//                ],
//            ],
//        ],
        'menu' => [
            'class' => 'app\components\Menu'
        ]
    ],
    'params' => $params,
    'modules' => $modules,
    'aliases' => [
        '@mdm/admin' => '@app/extensions/mdm/yii2-admin',
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
        // The actions listed here will be allowed to everyone including guests.
        // So, 'admin/*' should not appear here in the production, of course.
        // But in the earlier stages of your development, you may probably want to
        // add a lot of actions here until you finally completed setting up rbac,
        // otherwise you may not even take a first step.
        ]
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    //To generate MongoDB CRUD
    $config['modules']['gii1'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'mongoDbModel' => [
                'class' => 'yii\mongodb\gii\model\Generator'
            ]
        ]
    ];
}

return $config;
