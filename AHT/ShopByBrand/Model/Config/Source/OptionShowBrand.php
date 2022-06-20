<?php
namespace AHT\ShopByBrand\Model\Config\Source;

class OptionShowBrand implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            [
                'value' => '1',
                'label' => __('Show all')
            ],
            [
                'value' => '2',
                'label' => __('Show only name')
            ],
            [
                'value' => '3',
                'label' => __('Show only image')
            ]
        ];
    }
}