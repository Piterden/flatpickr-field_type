<?php namespace Defr\FlatpickrFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Defr\FlatpickrFieldType\Validation\ValidateDatetime;
use Illuminate\Config\Repository;

/**
 * Class FlatpickrFieldType
 *
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 *
 * @link   http://pyrocms.com/
 */
class FlatpickrFieldType extends FieldType
{

    /**
     * The database column type.
     *
     * @var string
     */
    protected $columnType = 'datetime';

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'defr.field_type.flatpickr::input';

    /**
     * The field type rules.
     *
     * @var array
     */
    protected $rules = [
        'datetime',
    ];

    /**
     * The field type validators.
     *
     * @var array
     */
    protected $validators = [
        'datetime' => [
            'handler' => ValidateDatetime::class,
            'message' => 'The date/time format is invalid.',
        ],
    ];

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'mode'        => 'datetime',
        'date_format' => null,
        'time_format' => null,
        'timezone'    => null,
    ];

    /**
     * The configuration repository.
     *
     * @var Repository
     */
    protected $configuration;

    /**
     * Create a new FlatpickrFieldType instance.
     *
     * @param Repository $configuration
     */
    public function __construct(Repository $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Get the config.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        $timezones = array_map(
            function ($timezone)
            {
                return strtolower($timezone);
            },
            timezone_identifiers_list()
        );

        // Check for default / erroneous timezone.
        if ((!$timezone = strtolower(array_get($config, 'timezone'))) || !in_array($timezone, $timezones))
        {
            $config['timezone'] = $this->configuration->get('app.timezone');
        }

        // Default date format.
        if (!$config['date_format'])
        {
            $config['date_format'] = $this->configuration->get('streams::datetime.date_format');
        }

        // Default time format.
        if (!$config['time_format'])
        {
            $config['time_format'] = $this->configuration->get('streams::datetime.time_format');
        }

        return $config;
    }

    /**
     * Get the column type.
     *
     * @return string
     */
    public function getColumnType()
    {
        return array_get($this->config, 'mode');
    }

    /**
     * Gets the date format.
     *
     * @return string The date format.
     */
    public function getDateFormat($default = null)
    {
        return array_get($this->getConfig(), 'date_format', $default);
    }

    /**
     * Gets the date format.
     *
     * @return string The date format.
     */
    public function getAltFormat($default = null)
    {
        return array_get($this->getConfig(), 'alt_format', $default);
    }

    /**
     * Gets the date format.
     *
     * @return string The date format.
     */
    public function getTimeFormat($default = null)
    {
        return array_get($this->getConfig(), 'time_format', $default);
    }

    /**
     * Get the post format.
     *
     * @return string
     */
    public function getDatetimeFormat()
    {
        $mode = array_get($this->getConfig(), 'mode');
        $date = $this->getDateFormat();
        $time = $this->getTimeFormat();

        if ($mode === 'datetime')
        {
            return $date.' '.$time;
        }

        return $mode === 'date' ? $date : $time;
    }

    /**
     * Get the storage format.
     *
     * @throws \Exception
     * @return string
     */
    public function getStorageFormat()
    {
        switch ($this->getColumnType())
        {
            case 'datetime':
                return 'Y-m-d H:i:S';
            case 'date':
                return 'Y-m-d';
            case 'time':
                return 'H:i:S';
        }

        throw new \Exception('Storage format can not be determined.');
    }

    /**
     * Get the output format.
     *
     * @param  null     $output
     * @return string
     */
    public function getOutputFormat($output = null)
    {
        switch ($this->getColumnType())
        {
            case 'datetime':
                return 'H:i, F j, Y';
            case 'date':
                return 'F j, Y';
            case 'time':
                return 'H:i';
        }

        return null;
    }

    /**
     * Gets the 24 hours flag.
     *
     * @return boolean The 24 hours.
     */
    public function get24Hours()
    {
        return str_contains($this->getStorageFormat(), 'H');
    }

    /**
     * Gets no calendar.
     *
     * @return boolean No calendar.
     */
    public function getNoCalendar()
    {
        return $this->getColumnType() == 'time';
    }

    /**
     * Gets no calendar.
     *
     * @return boolean No calendar.
     */
    public function getEnableTime()
    {
        return $this->getColumnType() != 'date';
    }
}
