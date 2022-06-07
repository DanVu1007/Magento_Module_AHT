<?php

namespace AHT\Actionuic\Controller\Adminhtml\Config;

class Index extends \Magento\Backend\App\Action
{
    const NAME = 'section_id/general/enable';

    const CONTENT = 'section_id/general/display_text';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->_pageFactory = $pageFactory;
        $this->scopeConfig = $scopeConfig;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $name = $this->scopeConfig->getValue(self::NAME);
        $content = $this->scopeConfig->getValue(self::CONTENT);
        echo "NAME: " . $name . "<br>" . "CONTENT: " . $content;
        die;
        echo "danbmt";
        die;
    }

    /**
     * Is the user allowed to view the page.
     *
     * @return bool
     */
    protected function _isAllowed()
    {

        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
