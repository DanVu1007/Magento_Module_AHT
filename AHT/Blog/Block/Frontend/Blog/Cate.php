<?php
namespace AHT\Blog\Block\Frontend\Blog;

class Cate extends \Magento\Framework\View\Element\Template
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

    public function filterCategory(){
        return $this->collectionFactory->create();
    }
}
