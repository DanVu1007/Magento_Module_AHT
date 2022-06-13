<?php

namespace AHT\Blog\Model\ResourceModel\Blog;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'blog_id';
    protected $_eventPrefix = 'aht_blog_blog_collection';
    protected $_eventObject = 'blog_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Blog\Model\Blog', 'AHT\Blog\Model\ResourceModel\Blog');
    }
    
    public function joinCollection($table, $id,$isRoot=true)
    {
        $roottable = ($isRoot == true) ? "main_table" : $table;
        $this->join(
            [ $table => $this->getTable($table)],
            $roottable.".".$id."= ".$table.".".$id,
            ''
        );
        return $this;
    }
}
