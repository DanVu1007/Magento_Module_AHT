<?php
namespace AHT\Actionuic\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('action_uic'))
            ->addColumn('uic_id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], 'Description')
            ->addColumn('name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, [], 'name')
            ->addColumn('status', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null, [], '1')
            ->setComment('Table comment');
        $installer->getConnection()->createTable($table);

        $installer->endSetup();

    }
}
