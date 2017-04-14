<?php

use Illuminate\Contracts\Config\Repository;

return [
    'mode'                    => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'options' => [
                'single' => 'defr.field_type.flatpickr::config.mode.single',
                // 'multiple' => 'defr.field_type.flatpickr::config.mode.multiple',
                // 'range'    => 'defr.field_type.flatpickr::config.mode.range',
            ],
        ],
    ],
    'date_format'             => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'F j, Y',
        ],
    ],
    'date_format'             => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'Y-m-d',
        ],
    ],
    'enable_time'             => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'no_calendar'             => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'shorthand_current_month' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'time_24hr'               => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'hour_increment'          => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'min'           => 1,
            'default_value' => 1,
        ],
    ],
    'allow_input'             => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'alt_input'               => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],

    // 'timezone'              => [
    //     'type'   => 'anomaly.field_type.select',
    //     'config' => [
    //         'handler' => 'timezones',
    //     ],
    // ],
];
