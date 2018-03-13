<?php

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@infinitylabs.in',
    'tftpServer' => '127.0.0.1',
    'mdm.admin.configs' => [
        'defaultUserStatus' => 0, // 0 = inactive, 10 = active
    ],
    'canSetGlobalCredentials' => ['sysadmin', 'admin'], // Roles which are allowdded to set global credentials
    'consumers' => require(__DIR__ . '/consumers.php'),
    'canDeleteJob' => ['sysadmin'],
    'canPurgeQueue' => ['sysadmin'],
    'GOOGLE_MAPS_API_KEY' => 'AIzaSyB9BDyVL7sIWO8H-1a7xhYhCvW5l8tCW7g'
];
