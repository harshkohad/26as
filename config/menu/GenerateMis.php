<?php

return [
    'label' => 'Reports',
    'icon' => 'fa fa-file-text',
    'url' => ['#'],
    'items' => [
        [
            'label' => 'Generate MIS',
            'url' => ['/generate_mis/generate-mis/index']
        ],
        [
            'label' => 'Generate PDF',
            'url' => ['/generate_mis/generate-mis/pdf-index']
        ],        
    ]
];
