<?php
declare(strict_types=1);

/**
 * @category    DMC
 * @package     DMC_Base
 * @author      digital.manufaktur GmbH / Hannover, Germany
 */

namespace DMC\Base\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    /**
     *
     * To use it in phtml:
     * $this->helper('\DMC\Base\Helper\Data')->getConfigByPath('section/group/field');
     *
     * To use it in block and helper:
     * $this->objectManager->create('DMC\Base\Helper\Data')->getConfigByPath('section/group/field');
     *
     * @param string $configPath
     * @param mixed  $storeCode
     *
     * @return mixed
     */
    public function getConfigByPath(string $configPath, $storeCode = null)
    {
        return $this->scopeConfig->getValue(
            $configPath,
            ScopeInterface::SCOPE_STORE,
            $storeCode
        );
    }

    /**
     * Use this as general option to replace column values
     *
     * @param        mixed $search
     * @param        mixed $replace
     * @param string       $column
     * @param array        $inputData
     *
     * @return array
     */
    public function replaceStringInColumn($search, $replace, string $column, array $inputData): array
    {
        return array_map(function ($row) use ($search, $replace, $column) {
            $row[$column] = str_replace($search, $replace, $row[$column]);

            return $row;
        }, $inputData);
    }
}