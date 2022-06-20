<?php
namespace AHT\ShopByBrand\Model\ResourceModel\Brand\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'brand_id';
    protected $_eventPrefix = 'aht_shopbybrand_brand_grid_collection';
    protected $_eventObject = 'brand_grid_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\ShopByBrand\Model\Brand\Grid', 'AHT\ShopByBrand\Model\ResourceModel\Brand\Grid');
    }
}
