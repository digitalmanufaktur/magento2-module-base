<?php
declare(strict_types=1);

/**
 * @category    DMC
 * @package     DMC_Base
 * @author      digital.manufaktur GmbH / Hannover, Germany
 */

namespace DMC\Base\Helper;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\ResourceConnection;
use Magento\Tax\Model\ClassModel;

class Catalog extends Data
{

    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    /**
     * Catalog constructor.
     *
     * @param Context            $context
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(Context $context, ResourceConnection $resourceConnection)
    {
        parent::__construct($context);
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * Get existing product SKUs which optional filter
     *
     * @param array $filterSkus
     *
     * @return array
     */
    public function getExistingProductSkus(array $filterSkus = []): array
    {
        $objConn = $this->resourceConnection->getConnection();
        $objSelect = $objConn->select();
        $objSelect
            ->from($this->resourceConnection->getTableName('catalog_product_entity'), '')
            ->columns('sku');
        if ($filterSkus) {
            $objSelect->where('sku IN (?)', array_unique($filterSkus));
        }

        $fetchData = $objConn->fetchCol($objSelect);

        // Set keys and values the same for cheap checks
        return array_combine($fetchData, $fetchData);

    }

    /**
     * Get existing product SKUs which optional filter
     *
     * @return array
     */
    public function getTaxClassMap(): array
    {
        $objConn = $this->resourceConnection->getConnection();
        $objSelect = $objConn->select();
        $objSelect
            ->from($this->resourceConnection->getTableName('tax_class'), '')
            ->columns('class_id')
            ->columns('class_name')
            ->where('class_type = ?', ClassModel::TAX_CLASS_TYPE_PRODUCT);

        // Set keys and values the same for cheap checks
        return $objConn->fetchPairs($objSelect);

    }

    /**
     * Get the SKUs from given data
     *
     * @param array  $chunk
     *
     * @param string $skuColumn
     *
     * @return array
     */
    public function getSkusFromArray(array $chunk, string $skuColumn): array
    {
        return array_column($chunk, $skuColumn);
    }

    /**
     * Get select data for option texts
     *
     * @param ProductInterface $product
     * @param string           $key
     *
     * @return string
     */
    public function getProductOptionText(ProductInterface $product, string $key): string
    {
        // Try flat data, works only when the flat index is enabled at runtime
        if ($product->hasData($key . '_value')) {
            return (string) $product->getData($key . '_value');
        }

        // Use the option text, check the attribute as a safety net first
        $attribute = $product->getResource()->getAttribute($key);
        if ($attribute && $attribute->getId() && $attribute->usesSource()) {
            return (string) $product->getAttributeText($key);
        }

        // Use the conventional data
        if (!$product->getDataUsingMethod($key)) {
            return '';
        }

        // Nothing found
        return '';
    }

}