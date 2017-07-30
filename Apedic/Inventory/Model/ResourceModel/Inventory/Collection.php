<?php


namespace Apedic\Inventory\Model\ResourceModel\Inventory;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'id';


    protected function _construct()
    {
        $this->_init('Apedic\Inventory\Model\Inventory', 'Apedic\Inventory\Model\ResourceModel\Inventory');
    }

}