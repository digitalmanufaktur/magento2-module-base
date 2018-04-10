<?php
declare(strict_types=1);

/**
 * @category    DMC
 * @package     DMC_Base
 * @author      digital.manufaktur GmbH / Hannover, Germany
 */

namespace DMC\Base\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Filter\FilterManager;

class Text extends AbstractHelper
{

    protected $filterManager;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context,
        FilterManager $filterManager
    )
    {
        $this->filterManager = $filterManager;
        parent::__construct($context);
    }

    /**
     * @param $value
     * @param int $length
     * @param string $etc
     * @param string $remainder
     * @param bool $breakWords
     * @return string
     */
    public function truncateString($value, $length = 80, $etc = '...', &$remainder = '', $breakWords = true): string
    {
        return $this->filterManager->truncate(
            $value,
            ['length' => $length, 'etc' => $etc, 'remainder' => $remainder, 'breakWords' => $breakWords]
        );
    }
}