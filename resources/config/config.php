<?php

use Illuminate\Contracts\Config\Repository;

return [
    'mode'                    => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'options' => [
                'datetime' => 'defr.field_type.flatpickr::config.mode.datetime',
                'date'     => 'defr.field_type.flatpickr::config.mode.date',
                'time'     => 'defr.field_type.flatpickr::config.mode.time',
            ],
        ],
    ],
    'theme'                   => [
        'type'     => 'anomaly.field_type.select',
        'required' => true,
        'config'   => [
            'options' => function ()
            {
                $list = array_map(
                    function ($path)
                    {
                        return str_replace(
                            '.css',
                            '',
                            array_reverse(explode('/', $path))[0]
                        );
                    },
                    glob(__DIR__.'/../css/themes/*.css')
                );

                return array_combine($list, $list);
            },
        ],
    ],
    'time_format'             => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'H:i',
        ],
    ],
    'date_format'             => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'Y-m-d',
        ],
    ],
    'alt_input'               => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'alt_format'              => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'F j, Y',
        ],
    ],
    'shorthand_current_month' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'time24hr'                => [
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
    'minute_increment'        => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'min'           => 1,
            'default_value' => 15,
        ],
    ],
    'allow_input'             => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => false,
        ],
    ],
    'timezone'                => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'mode'    => 'search',
            'handler' => 'timezones',
        ],
    ],
];
