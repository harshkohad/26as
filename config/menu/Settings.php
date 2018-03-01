<?php

return [
    'label' => 'Settings',
    'icon' => 'fa fa-gears',
    'url' => ['#'],
    'visible' => Yii::$app->user->can('sysadmin'),
    'items' => [
        [
            'label' => 'User Management',
            'url' => ['/admin/user/index'],
//            'visible' => Yii::$app->user->can('sysadmin'),
        ],
        [
            'label' => 'Role Assignment',
            'url' => ['/admin/assignment/index']
        ],
        [
            'label' => 'Manage Roles',
            'url' => ['/admin/role/index']
        ],
        [
            'label' => 'Manage Permissions',
            'url' => ['/admin/permission/index']
        ],
        [
            'label' => 'Manage Routes',
            'url' => ['/admin/route/index']
        ],
        [
            'label' => 'Manage Templates',
            'url' => ['/applications/institute-header-template/create-template']
        ],
    ]
];
