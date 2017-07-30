<?php
/**
 * Created by PhpStorm.
 * User: apedic
 * Date: 26/07/2017
 * Time: 21:27
 */

namespace Apedic\Inventory\Setup;

const COLUMN_NAME = 'product_id';
const COLUMNFK_NAME = 'entity_id';

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     *
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */


    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {

        $installer = $setup;
        $installer->startSetup();


        $tableName = 'apedic_inventory';
        $tableNameFkName = 'catalog_product_entity';
        if (!$installer->tableExists($tableName)) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable($tableName)
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'ID'
                )
                ->addColumn(
                    'product_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false,
                        'unsigned' => true,
                    ],
                    'product id'
                )
                ->addColumn(
                    'value',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'quantity'
                )
                ->addColumn(
                    'triggered_by',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'triggered by'
                )
                ->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' =>false],
                    'Updated At'
                )
                ->addForeignKey(
                    $installer->getFkName($tableName, COLUMN_NAME, $tableNameFkName, COLUMNFK_NAME),
                    COLUMN_NAME,
                    $installer->getTable($tableNameFkName),
                    COLUMNFK_NAME,
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ;

            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}