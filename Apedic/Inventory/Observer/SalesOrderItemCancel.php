<?php

namespace Apedic\Inventory\Observer;
use Apedic\Inventory\Model\Inventory;
use Magento\Framework\Event\Observer;
use \Magento\Framework\Registry;

class SalesOrderItemCancel implements \Magento\Framework\Event\ObserverInterface{

    public function __construct(Inventory $inventory,  Registry $registry)
    {
        $this->inventory=$inventory;
        $this->registry=$registry;
    }

    public function execute(Observer $observer)
    {
        // TODO: Implement execute() method.
    }
}