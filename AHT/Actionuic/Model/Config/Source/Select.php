<?php

namespace AHT\Actionuic\Model\Config\Source;

class Select implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @param \AHT\Actionuic\Model\ResourceModel\Actionuic\CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        \AHT\Actionuic\Model\ResourceModel\Actionuic\CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }
    public function toOptionArray()
    {
        $values = $this->collectionFactory->create()->getData();
        $arrayUse = [
            [
                'value' => null,
                'label' => __('--Please Select--')
            ]
        ];

        $arrayValue = [];
        foreach ($values as $key => $value) {
            $arrayValue['value'] = $value['uic_id'];
            $arrayValue['label'] = __($value['name']);
            array_push($arrayUse, $arrayValue);
        }

        return $arrayUse;
    }
}
