<?php

return [
    'label' => 'Announacements',
    'icon' => 'fa fa-book',
    'url' => ['#'],
    'items' => [
        [
            'label' => 'Notifications',
            'url' => ['/announacements/manage-announacements/manage-notifications']
        ],
        [
            'label' => 'Alerts',
            'url' => ['/announacements/manage-announacements/manage-alerts']
        ]        
    ]
];

