<?php
namespace AHT\Actionuic\Block\FrontEnd;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \AHT\Actionuic\Model\ResourceModel\Actionuic\CollectionFactory
     */
    private $collection;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Actionuic\Model\ResourceModel\Actionuic\CollectionFactory $collection,
        array $data = []
    ) {
        $this->collection = $collection;
        parent::__construct($context, $data);
    }
    public function getDataUIC()
    {
        return $this->collection->create();
    }
}
