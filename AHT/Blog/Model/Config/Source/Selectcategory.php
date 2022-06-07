<?php
namespace AHT\Blog\Model\Config\Source;

class Selectcategory implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @param \AHT\Blog\Model\ResourceModel\Blogcategory\CollectionFactory
     */
    private $collection;

    public function __construct(
        \AHT\Blog\Model\ResourceModel\Blogcategory\CollectionFactory $collection
    )
    {
        $this->collection = $collection;
        
    }
    public function toOptionArray()
    {
        $values = $this->collectionFactory->create()->getData();
        $arrayUse = [
            [
                'value' => 0,
                'label' => __('--Root Category--')
            ]
        ];

        $arrayValue = [];
        foreach ($values as $key => $value) {
            $arrayValue['value'] = $value['blog_category_id'];
            $arrayValue['label'] = __($value['name']);
            array_push($arrayUse, $arrayValue);
        }

        return $arrayUse;
    }
}