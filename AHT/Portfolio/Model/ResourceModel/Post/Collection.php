<?php
namespace AHT\Portfolio\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'danPort_id';
    protected $_eventPrefix = 'aht_portfolio_post_collection';
    protected $_eventObject = 'post_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Portfolio\Model\Post', 'AHT\Portfolio\Model\ResourceModel\Post');
    }
}
