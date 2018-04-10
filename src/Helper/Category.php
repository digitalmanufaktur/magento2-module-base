<?php
declare(strict_types=1);

/**
 * @category    DMC
 * @package     DMC_Base
 * @author      digital.manufaktur GmbH / Hannover, Germany
 */

namespace DMC\Base\Helper;

use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

/**
 * Class Category
 *
 * @package DMC\Base\Helper
 */
class Category extends AbstractHelper
{

    /** @var \Magento\Catalog\Model\Layer */
    private $_catalogLayer;

    /**
     * Category constructor.
     * @param Context $context
     * @param Resolver $layerResolver
     */
    public function __construct(
        Context $context,
        Resolver $layerResolver
    )
    {
        $this->_catalogLayer = $layerResolver->get();
        parent::__construct($context);
    }

    /**
     * @return \Magento\Catalog\Model\Category
     */
    public function getCurrentCategory(): \Magento\Catalog\Model\Category
    {
        return $this->_catalogLayer->getCurrentCategory();
    }
}