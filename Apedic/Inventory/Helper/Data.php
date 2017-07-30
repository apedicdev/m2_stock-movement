<?php

namespace Apedic\Inventory\Helper;
use Apedic\Inventory\Model\Inventory;
use Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper{

    protected $inventory;
    /**
     * @param $product_id
     * @param $product_sku
     * @param $qty
     * @param $qtyOrig
     * @param $triggered_by
     */

    public function __construct(Inventory $inventory)
    {
        $this->inventory=$inventory;
    }

    public function setInventoryMovementData($triggered_by, $product_id, $product_sku, $qty, $qtyVariation)
    {
        $this->inventory->setTriggeredBy($triggered_by)
            ->setProductId($product_id)
            ->setProductSku($product_sku)
            ->setValue($qty)
            ->setVariation($qtyVariation);
        $this->inventory->save();
    }
}