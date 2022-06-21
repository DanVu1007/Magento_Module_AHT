<?php

namespace AHT\ShopByBrand\Block\Frontend\Brand;

class Index extends \Magento\Framework\View\Element\Template
{
    // const SORT_ORDER_ASC = 'ASC';

    // const SORT_ORDER_DESC = 'DESC';
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

        $name = $this->getRequest()->getParam('name');
        $orderby = $this->getRequest()->getParam('orderby');

        //search by Name: param: nameSearch;
        if($name != null){
            $collection->addFieldToFilter('name', ['like' => '%' . $name . '%']);
        }

        //sort: ORDER BY column1, column2, ... ASC|DESC
        if($orderby == $collection::SORT_ORDER_ASC){
            $collection->setOrder('name',$collection::SORT_ORDER_ASC);
        }
        if($orderby == $collection::SORT_ORDER_DESC){
            $collection->setOrder('name',$collection::SORT_ORDER_DESC);
        }

        return $collection;
    }
}
