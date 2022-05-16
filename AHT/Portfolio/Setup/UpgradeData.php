<?php
namespace AHT\Portfolio\Setup;


use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    /**
     * @param \AHT\Portfolio\Model\PostFactory
     */
    private $_postFactory;

    public function __construct(
        \AHT\Portfolio\Model\PostFactory $postFactory
    )
    {
        $this->_postFactory = $postFactory;
        
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.6', '<')) {
			$data = [
				'name'         => "Magento 2 Events",
				'content' => "This article will talk about Events List in Magento 2. As you know, Magento 2 is using the events driven architecture which will help too much to extend the Magento functionality. We can understand this event as a kind of flag that rises when a specific situation happens. We will use an example module Mageplaza_HelloWorld to exercise this lesson.",
			];
			$post = $this->_postFactory->create();
			$post->addData($data)->save();
		}
    }
}