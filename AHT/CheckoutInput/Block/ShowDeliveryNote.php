<?php
namespace AHT\CheckoutInput\Block;

class ShowDeliveryNote extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    private $orderFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        array $data = []
    ) {
        $this->orderFactory = $orderFactory;
        parent::__construct($context, $data);
    }

    public function showDeliNote(){
        $saleOrderId = $this->getRequest()->getParam('order_id');
        $orderById = $this->orderFactory->create()->load($saleOrderId);
        return $orderById->getDelivery_note();
    }
}
