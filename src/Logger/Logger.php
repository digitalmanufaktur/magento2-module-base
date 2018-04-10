<?php
declare(strict_types=1);
/**
 * @category    DMC
 * @package     DMC_Base
 * @author      digital.manufaktur GmbH / Hannover, Germany
 */

namespace DMC\Base\Logger;

use DMC\Base\Helper\Data;

class Logger extends \Monolog\Logger
{

    const CONFIG_PATH_LOG_ENABLE = 'dmc_base/log/enable';

    /**
     * Check for enabled logging
     *
     * @var bool $isLoggingEnabled
     */
    protected $isLoggingEnabled = false;

    /**
     * @var Data
     */
    protected $data;

    /**
     * Logger constructor.
     *
     * @param Data $data
     * @param                        $name
     * @param array $handlers
     * @param array $processors
     */
    public function __construct(
        Data $data,
        string $name, array $handlers = [], array $processors = []
    )
    {
        $this->data = $data;
        $this->isLoggingEnabled = $this->data->getConfigByPath(static::CONFIG_PATH_LOG_ENABLE);
        parent::__construct($name, $handlers, $processors);
    }

    /**
     * Adds a log record.
     *
     * @param  integer $level The logging level
     * @param  string $message The log message
     * @param  array $context The log context
     *
     * @return Boolean Whether the record has been processed
     */
    public function addRecord($level, $message, array $context = []): bool
    {
        if ($this->isLoggingEnabled) {
            parent::addRecord($level, $message, $context);
        }

        return true;
    }
}