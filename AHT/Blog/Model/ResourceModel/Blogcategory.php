<?php
namespace AHT\Blog\Model\ResourceModel;

class Blogcategory extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('blog_category', 'blog_category_id');
    }
}
