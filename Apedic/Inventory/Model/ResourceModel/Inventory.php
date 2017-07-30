<?php

namespace Apedic\Inventory\Model\ResourceModel;

class Inventory extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('apedic_inventory', 'id');
    }

}