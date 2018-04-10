<?php
declare(strict_types=1);
/**
 * @category    DMC
 * @package     DMC_Base
 * @author      digital.manufaktur GmbH / Hannover, Germany
 */
namespace DMC\Base\Logger;

use Magento\Framework\Logger\Handler\Base;

class Handler extends Base
{

    protected $fileName = '/var/log/dmc/base.log';

    protected $loggerType = Logger::DEBUG;

}