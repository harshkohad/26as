<?php

return [
    'admin' => [
        'class' => 'mdm\admin\Module',
    ],
    'gridview' => [
        'class' => '\kartik\grid\Module'
    ],
    'datecontrol' => [
        'class' => 'kartik\datecontrol\Module',
        // format settings for displaying each date attribute (ICU format example)
        'displaySettings' => [
            \kartik\datecontrol\Module::FORMAT_DATE => 'dd-MM-yyyy',
            \kartik\datecontrol\Module::FORMAT_TIME => 'HH:mm:ss a',
            \kartik\datecontrol\Module::FORMAT_DATETIME => 'dd-MM-yyyy HH:mm:ss a',
        ],
        // format settings for saving each date attribute (PHP format example)
        'saveSettings' => [
            \kartik\datecontrol\Module::FORMAT_DATE => 'php:U', // saves as unix timestamp
            \kartik\datecontrol\Module::FORMAT_TIME => 'php:H:i:s',
            \kartik\datecontrol\Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
        ],
        // set your display timezone
        'displayTimezone' => 'Asia/Kolkata',
        // set your timezone for date saved to db
        'saveTimezone' => 'UTC',
        // automatically use kartik\widgets for each of the above formats
        'autoWidget' => true,
        // use ajax conversion for processing dates from display format to save format.
        'ajaxConversion' => true,
        // default settings for each widget from kartik\widgets used when autoWidget is true
        'autoWidgetSettings' => [
            \kartik\datecontrol\Module::FORMAT_DATE => ['type' => 2, 'pluginOptions' => ['autoclose' => true]], // example
            \kartik\datecontrol\Module::FORMAT_DATETIME => [], // setup if needed
            \kartik\datecontrol\Module::FORMAT_TIME => [], // setup if needed
        ],
        // custom widget settings that will be used to render the date input instead of kartik\widgets,
        // this will be used when autoWidget is set to false at module or widget level.
        'widgetSettings' => [
            \kartik\datecontrol\Module::FORMAT_DATE => [
                'class' => 'yii\jui\DatePicker', // example
                'options' => [
                    'dateFormat' => 'php:d-M-Y',
                    'options' => ['class' => 'form-control'],
                ]
            ]
        ]
    ],
    'test' => [
        'class' => 'app\modules\test\Module'
    ],
    'request' => [
        'class' => 'app\modules\request\Module'
    ],
];
