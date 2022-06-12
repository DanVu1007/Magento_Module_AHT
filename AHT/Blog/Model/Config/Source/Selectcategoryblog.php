<?php
namespace AHT\Blog\Model\Config\Source;

class Selectcategoryblog implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @param \AHT\Blog\Model\ResourceModel\Blogcategory\CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        \AHT\Blog\Model\ResourceModel\Blogcategory\CollectionFactory $collection
    )
    {
        $this->collectionFactory = $collection;
        
    }
    public function toOptionArray()
    {
        $values = $this->collectionFactory->create()->getData();
        $arrayUse = [];
       

        $arrayValue = [];
        foreach ($values as $key => $value) {
            $arrayValue['value'] = $value['blog_category_id'];
            $arrayValue['label'] = __($value['name']);
            array_push($arrayUse, $arrayValue);
        }

        return $arrayUse;
    }
}