<?php

return [
    'label' => 'Announcements',
    'icon' => 'fa fa-book',
    'url' => ['#'],
    'items' => [
        [
            'label' => 'Notifications',
            'url' => ['/announcements/manage-announacements/manage-notifications']
        ],
        [
            'label' => 'Alerts',
            'url' => ['/announcements/manage-announacements/manage-alerts']
        ]        
    ]
];

