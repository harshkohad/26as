<?php

return [
    'label' => 'Announcements',
    'icon' => 'fa fa-book',
    'url' => ['#'],
    'items' => [
        [
            'label' => 'Notifications',
            'url' => ['/announcements/manage-announcements/manage-notifications']
        ],
        [
            'label' => 'Alerts',
            'url' => ['/announcements/manage-announcements/manage-alerts']
        ]        
    ]
];

