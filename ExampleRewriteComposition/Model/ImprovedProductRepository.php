<?php
/**
 * Copyright © Tuna, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Tuna\ExampleRewriteComposition\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Class ImprovedProductRepository
 * @package Tuna\ExampleRewriteComposition\Model
 */
class ImprovedProductRepository implements ProductRepositoryInterface
{
    private $original;

    public function __construct(ProductRepository $original)
    {
        $this->original = $original;
    }

    public function save(ProductInterface $product, $saveOptions = false)
    {
        return $this->original->save($product, $saveOptions);
    }

    public function get($sku, $editMode = false, $storeId = null, $forceReload = false)
    {
        return $this->original->get($sku, $editMode, $storeId, $forceReload);
    }

    public function getById($productId, $editMode = false, $storeId = null, $forceReload = false)
    {
        return $this->original->getById($productId, $editMode, $storeId, $forceReload);
    }

    public function delete(ProductInterface $product)
    {
        return $this->original->delete($product);
    }

    public function deleteById($sku)
    {
        return $this->original->deleteById($sku);
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        return $this->original->getList($searchCriteria);
    }

    public function getYourNewMethod()
    {
        //Do something new
    }

    public function __call($name, array $arguments)
    {
        if (method_exists($this->original, $name)) {
            return $this->original->$name($arguments);
        }

        trigger_error('Call to undefined method ' . __CLASS__ . '::' . $name . '()', E_USER_ERROR);
    }
}
