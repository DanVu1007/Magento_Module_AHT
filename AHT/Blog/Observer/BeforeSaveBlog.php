<?php
namespace AHT\Blog\Observer;

class BeforeSaveBlog implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \AHT\Blog\Model\ResourceModel\Blog\CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        \AHT\Blog\Model\ResourceModel\Blog\CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // $myEventData = $observer->getData('myEventData');
        $objectData = $observer->getData('data_object');
        $url = strtolower(str_replace(' ', '-', trim($objectData['url'])));

        $arrBlogUrl = $this->collectionFactory->create()->getData();

        foreach ($arrBlogUrl as $key => $value) {
            if($value['url'] == $url){
                throw new \Magento\Framework\Exception\CouldNotDeleteException(__("The url is exits!"));
            }
        }

        $objectData->setData('url', $url);
        return $this;
    }
}