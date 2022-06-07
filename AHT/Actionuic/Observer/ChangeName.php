<?php

namespace AHT\Actionuic\Observer;

class ChangeName implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct()
    {
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // echo 'observer';die;
        $myEventData = $observer->getData('totalData');
        $myEventData->setData('name', "The observe has set a new name");
        $observer->setData('totalData', $myEventData);
        // var_dump($observer);die;
    }
}
