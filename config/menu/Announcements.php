<?php

return [
    'label' => 'Announcements',
    'icon' => 'fa fa-bullhorn',
    'url' => ['#'],
    'items' => [
        [
            'label' => 'Notifications',
            'url' => ['/announcements/manage-announcements/manage-notifications']
        ],
        [
            'label' => 'Alerts',
            'url' => ['/announcements/manage-announcements/manage-alerts']
        ],
        [
            'label' => 'Manage Alerts',
            'url' => ['/announcements/manage-announcements/admin-manage-alerts']
        ]
    ]
];

