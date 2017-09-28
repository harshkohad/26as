<?php

return [
    'label' => Yii::$app->user->identity->emp_name,
    'items' => [
        [
            'label' => 'View My Profile',
            'url' => ['/admin/user/view']
        ],
        [
            'label' => 'Change Password',
            'url' => ['/admin/user/change-password']
        ],
        [
            'label' => 'Logout',
            'url' => ['/admin/user/logout'],
            'linkOptions' => ['data-method' => 'post']
        ],
    ],
];
