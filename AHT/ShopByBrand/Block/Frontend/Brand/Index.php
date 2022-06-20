<?php

namespace AHT\ShopByBrand\Block\Frontend\Brand;

class Index extends \Magento\Framework\View\Element\Template
{
    
    /**
     * @var \AHT\ShopByBrand\Model\ResourceModel\Brand\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\ShopByBrand\Model\ResourceModel\Brand\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function showBrandCollection()
    {
        $collection = $this->collectionFactory->create()->addFieldToFilter('status', 1);

        $request = $this->getRequest()->getParams();
        //nameSeach , sort/
        echo '<pre>';
        print_r($request);
        echo '</pre>';
        exit();

        return $collection;
    }
}
