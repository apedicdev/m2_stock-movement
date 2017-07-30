<?php

namespace Apedic\Inventory\Observer;
use Apedic\Inventory\Model\Inventory;
use \Magento\Framework\Registry;

class CatalogInventorySave implements \Magento\Framework\Event\ObserverInterface {
    protected $inventory;
    protected $registry;

    public function __construct(Inventory $inventory,  Registry $registry)
    {
        $this->inventory=$inventory;
        $this->registry=$registry;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        $this->_setInventoryMovementData($this->_getProductId($observer),
            $this->_getProductSku($observer),
            $this->_getQty($observer),
            $this->_getQtyOrig($this->_getOrigData()));

        $this->inventory->save();
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return mixed
     */
    protected function _getProductId(\Magento\Framework\Event\Observer $observer)
    {
        $product_id = $observer->getEvent()->getItem()->getProductId();
        return $product_id;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return mixed
     */
    protected function _getProductSku(\Magento\Framework\Event\Observer $observer)
    {
        $origData =$this->_getOrigData();
        $product_sku=$origData['sku'];
        return $product_sku;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return mixed
     */
    protected function _getQty(\Magento\Framework\Event\Observer $observer)
    {
        $qty = $observer->getEvent()->getItem()->getQty();
        return $qty;
    }

    /**
     * @return mixed
     */
    protected function _getOrigData()
    {
        $origData = $this->registry->registry('product')->getOrigData();
        return $origData;
    }

    /**
     * @param $origData
     * @return mixed
     */
    protected function _getQtyOrig($origData)
    {
        $qtyOrig = $origData['quantity_and_stock_status']['qty'];
        return $qtyOrig;
    }

    /**
     * @param $product_id
     * @param $product_sku
     * @param $qty
     * @param $qtyOrig
     */
    protected function _setInventoryMovementData($product_id, $product_sku, $qty, $qtyOrig)
    {
        $this->inventory->setTriggeredBy('adminhtml')
            ->setProductId($product_id)
            ->setProductSku($product_sku)
            ->setValue($qty)
            ->setVariation($this->_getQtyVariation($qty, $qtyOrig));
    }

    /**
     * @param $qty
     * @param $qtyOrig
     * @return mixed
     */
    protected function _getQtyVariation($qty, $qtyOrig)
    {
        return $qty - $qtyOrig;
    }
}