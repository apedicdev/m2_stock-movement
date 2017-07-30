<?php

namespace Apedic\Inventory\Observer;
use Apedic\Inventory\Model\Inventory;
use Magento\Framework\Event\Observer;
use \Magento\Framework\Registry;
use Apedic\Inventory\Helper\Data as Helper;
use \Magento\CatalogInventory\Model\Stock\StockItemRepository;

class CheckoutSubmitAllAfter implements \Magento\Framework\Event\ObserverInterface{

    protected $inventory;
    protected $registry;
    protected $helper;
    protected $triggered_by;
    protected $stockItemRepository;
    protected $item;

    const TRIGGERED_BY_ORDER = 'order';

    public function __construct(Inventory $inventory, Registry $registry, Helper $helper, StockItemRepository $stockItemRepository)
    {
        $this->inventory=$inventory;
        $this->registry=$registry;
        $this->helper=$helper;
        $this->stockItemRepository=$stockItemRepository;


    }

    public function execute(Observer $observer)
    {

        $order = $this->_getOrder($observer);
        $items = $this->_getItems($order);

        foreach ($items as $this->item){
            $this->helper->setInventoryMovementData(self::TRIGGERED_BY_ORDER,
                $this->_getProductId(),
                $this->_getProductSku(),
                $this->_getFinalQty(),
                $this->_getQtySold());
        }

    }

    /**
     * @param Observer $observer
     * @return mixed
     */
    protected function _getOrder(Observer $observer)
    {
        $order = $observer->getOrder();
        return $order;
    }

    /**
     * @param $order
     * @return mixed
     */
    protected function _getItems($order)
    {
        $items = $order->getItems();
        return $items;
    }

    /**
     * @param $item
     * @return mixed
     */
    protected function _getProductSku()
    {
        $product_sku = $this->item->getSku();
        return $product_sku;
    }

    /**
     * @param $item
     * @return mixed
     */
    protected function _getProductId()
    {
        $product_id = $this->item->getProductId();
        return $product_id;
    }

    /**
     * @param $product_id
     * @return \Magento\CatalogInventory\Api\Data\StockItemInterface
     */
    protected function _getStockItem($product_id): \Magento\CatalogInventory\Api\Data\StockItemInterface
    {
        $stockItem = $this->stockItemRepository->get($product_id);
        return $stockItem;
    }

    /**
     * @param $stockItem
     * @return mixed
     */
    protected function _getStockItemQty($stockItem)
    {
        $stockItemQty = $stockItem->getQty();
        return $stockItemQty;
    }

    /**
     * @param $item
     * @return mixed
     */
    protected function _getFinalQty()
    {
        $stockItem = $this->_getStockItem($this->_getProductId($this->item));
        $stockItemQty = $this->_getStockItemQty($stockItem);
        return $stockItemQty;
    }

    /**
     * @return mixed
     */
    protected function _getQtySold()
    {
        return -($this->item->getQtyOrdered());
    }
}