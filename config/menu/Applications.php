<?php

return [
    'label' => 'Applications',
    'icon' => 'fa fa-book',
    'url' => ['#'],
    'items' => [
        [
            'label' => 'Dedupe Check',
            'url' => ['/applications/dedupe-check/index']
        ],
        [
            'label' => 'Applicant Profile',
            'url' => ['/applications/applicant-profile/index']
        ],
        [
            'label' => 'Manage Applications',
            'url' => ['/applications/manage-applications/index']
        ],
        [
            'label' => 'Create Application',
            'url' => ['/applications/manage-applications/create']
        ],
        [
            'label' => 'Upload Applications',
            'url' => ['/applications/manage-applications/upload-applications']
        ],
        [
            'label' => 'Manage Templates',
            'url' => ['/applications/institute-header-template/create-template']
        ],
    ]
];

