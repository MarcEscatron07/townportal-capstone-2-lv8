<?php

return [
    'providers' => [
        '1' => 'PLDT',
        '2' => 'Globe',
        '3' => 'Converge',
        '4' => 'DITO',
        '5' => 'Starlink',
    ],
    'statuses' => [
        '1' => 'Available',
        '2' => 'In Use',
        '3' => 'Under Maintenance',
    ],
    'types' => [
        '1' => 'Headphone',
        '2' => 'Keyboard',
        '3' => 'Monitor',
        '4' => 'Mouse',
        '5' => 'Webcam',
    ],
    'categories' => [
        '1' => 'Food',
        '2' => 'Drinks',
        '3' => 'Merchandise',
    ],
    'modules' => [
        'Networks',
        'Computers',
        'Peripherals',
        'Products',
    ],
    'columns' => [
        'Networks' => [
            'provider_id' => 'Provider',
            'name' => 'Name',
            'cost' => 'Cost',
            'remarks' => 'Remarks',
        ],
        'Computers' => [
            'network_id' => 'Network',
            'status_id' => 'Status',
            'name' => 'Name',
            'remarks' => 'Remarks',
        ],
        'Peripherals' => [
            'computer_id' => 'Computer',
            'type_id' => 'Type',
            'name' => 'Name',
            'brand' => 'Brand',
            'model' => 'Model',
            'serial_number' => 'Serial No.',
            'cost' => 'Cost',
            'remarks' => 'Remarks',
        ],
        'Products' => [
            'category_id' => 'Category',
            'name' => 'Name',
            'stock' => 'Stock',
            'cost' => 'Cost',
            'remarks' => 'Remarks',
        ],
    ],
];
