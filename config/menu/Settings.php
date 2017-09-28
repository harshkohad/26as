<?php

return [
    'label' => 'Settings',
    'url' => ['#'],
    'items' => [
        [
            'label' => 'User Management',
            'url' => ['/admin/user/index']
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
    ]
];
