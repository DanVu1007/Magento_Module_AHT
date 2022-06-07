<?php

namespace ViMagento\HelloWorld\Controller\Adminhtml\Config;

use Magento\Backend\App\Action;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Index2 extends \Magento\Backend\App\Action
{

    const ENABLE = "dan_id/general/enable";
    const DISPLAY_TEXT = "dan_id/general/display_text";

    protected $scopeConfig;

    public function __construct(
        Action\Context $context,
        ScopeConfigInterface  $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function execute()
    {
        echo 123;
        die;
        $enable = $this->scopeConfig->getValue(self::ENABLE, ScopeInterface::SCOPE_STORE);
        $displayText = $this->scopeConfig->getValue(self::DISPLAY_TEXT, ScopeInterface::SCOPE_STORE);
        echo $enable;
        echo "<br>";
        echo $displayText;
    }
}
