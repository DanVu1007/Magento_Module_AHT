<?php
namespace AHT\Blog\Block\Frontend\Category;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \AHT\Blog\Model\ResourceModel\Blogcategory\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Blog\Model\ResourceModel\Blogcategory\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getCollectionCategory(){
        return $this->collectionFactory->create();
    }

    
    
}
