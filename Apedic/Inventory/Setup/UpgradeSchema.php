<?php


namespace Apedic\Inventory\Setup;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
{
    /**
     *
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $setup->startSetup();


        if (version_compare($context->getVersion(), '0.1.1', '<=')) {
            $setup->getConnection()->addColumn($setup->getTable( 'apedic_inventory'),
                              'variation',
                              [
                                  'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                                  'length' => 11,
                                  'nullable' => true,
                                  'comment' => 'variation'
                              ]
                          );
        }

        if (version_compare($context->getVersion(), '0.1.2', '<=')) {
            $setup->getConnection()->addColumn($setup->getTable( 'apedic_inventory'),
                'product_sku',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => false,
                    'comment' => 'product_sku'
                ]
            );
        }




        $setup->endSetup();
    }
}