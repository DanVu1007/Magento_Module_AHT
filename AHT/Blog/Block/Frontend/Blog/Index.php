<?php
namespace AHT\Blog\Block\Frontend\Blog;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \AHT\Blog\Model\ResourceModel\Blog\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Blog\Model\ResourceModel\Blog\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }
    
    public function getCollectionBlog()
    {
        $date = date("Y-m-d h:i:s");
        return $this->collectionFactory->create()->addFieldToFilter('status',1);
    }
}
