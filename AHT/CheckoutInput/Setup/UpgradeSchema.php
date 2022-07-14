<?php
namespace AHT\CheckoutInput\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $installer->getConnection()->addColumn(
                $installer->getTable('quote'),
                'delivery_note',
                [
                    'type' => 'text',
                    'nullable' => true,
                    'comment' => 'no note',
                ]
            );
            
    
            $installer->getConnection()->addColumn(
                $installer->getTable('sales_order'),
                'delivery_note',
                [
                    'type' => 'text',
                    'nullable' => true,
                    'comment' => 'no note',
                ]
            );
    
            $installer->getConnection()->addColumn(
                $installer->getTable('sales_order_grid'),
                'delivery_note',
                [
                    'type' => 'text',
                    'nullable' => true,
                    'comment' => 'no note',
                ]
            );
    
            $setup->endSetup();
        }
    }

}
