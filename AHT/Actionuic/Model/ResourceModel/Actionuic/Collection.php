<?php
namespace AHT\Actionuic\Model\ResourceModel\Actionuic;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'uic_id';
    protected $_eventPrefix = 'aht_actionuic_actionuic_collection';
    protected $_eventObject = 'actionuic_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Actionuic\Model\Actionuic', 'AHT\Actionuic\Model\ResourceModel\Actionuic');
    }
}
