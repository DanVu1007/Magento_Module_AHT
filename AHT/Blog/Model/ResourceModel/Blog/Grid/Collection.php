<?php
namespace AHT\Blog\Model\ResourceModel\Blog\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'blog_id';
    protected $_eventPrefix = 'aht_blog_blog_grid_collection';
    protected $_eventObject = 'blog_grid_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Blog\Model\Blog\Grid', 'AHT\Blog\Model\ResourceModel\Blog\Grid');
    }
}
