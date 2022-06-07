<?php
namespace AHT\Blog\Model\ResourceModel\Blogcategory\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'blog_category_id';
    protected $_eventPrefix = 'aht_blog_blogcategory_grid_collection';
    protected $_eventObject = 'blogcategory_grid_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Blog\Model\Blogcategory\Grid', 'AHT\Blog\Model\ResourceModel\Blogcategory\Grid');
    }
}
