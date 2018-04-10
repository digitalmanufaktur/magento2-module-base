<?php
declare(strict_types=1);
/**
 * @category    DMC
 * @package     DMC_Base
 * @author      digital.manufaktur GmbH / Hannover, Germany
 */

namespace DMC\Base\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Monolog\Logger;

class LogLevel implements ArrayInterface
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $arrLogLevels = ['ALL (including custom)' => 0];
        $arrLogLevels += Logger::getLevels();
        $arrOptions = array_map(function (string $key, string $value) {
            return [
                'label' => $key,
                'value' => $value,
            ];

        }, array_keys($arrLogLevels), $arrLogLevels);

        return $arrOptions;

    }

}