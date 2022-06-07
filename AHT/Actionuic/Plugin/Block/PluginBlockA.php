<?php

namespace AHT\Actionuic\Plugin\Block;

class PluginBlockA extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\Controller\Result\Redirect
     */
    private $resultRedirectFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        array $data = []
    ) {
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context, $data);
    }

    public function afterExecute(\Magento\Customer\Controller\Account\Login $subject, $result)
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('redocrud/redo/');
        return $resultRedirect;
    }
}
