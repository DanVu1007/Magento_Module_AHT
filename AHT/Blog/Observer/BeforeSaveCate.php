<?php
namespace AHT\Blog\Observer;

class BeforeSaveCate implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \AHT\Blog\Model\ResourceModel\Blogcategory\CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        \AHT\Blog\Model\ResourceModel\Blogcategory\CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // $myEventData = $observer->getData('myEventData');
        $objectData = $observer->getData('data_object');
        $name = trim($objectData['name']);

        $arrBlogname = $this->collectionFactory->create()->getData();

        foreach ($arrBlogname as $key => $value) {
            if($value['name'] == $name){
                throw new \Magento\Framework\Exception\CouldNotDeleteException(__("The name is exits!"));
            }
        }

        $objectData->setData('name', $name);
        return $this;
    }
}