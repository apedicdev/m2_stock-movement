<?php
/**
 * Created by PhpStorm.
 * User: apedic
 * Date: 26/07/2017
 * Time: 21:27
 */

namespace Apedic\Inventory\Model;

/**
 * @method \Apedic\Inventory\Model\ResourceModel\Inventory getResource()
 * @method \Apedic\Inventory\Model\ResourceModel\Inventory\Collection getCollection()
 */
class Inventory extends \Magento\Framework\Model\AbstractModel implements \Apedic\Inventory\Api\Data\InventoryInterface,
    \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'apedic_inventory_inventory';
    protected $_cacheTag = 'apedic_inventory_inventory';
    protected $_eventPrefix = 'apedic_inventory_inventory';

    protected function _construct()
    {
        $this->_init('Apedic\Inventory\Model\ResourceModel\Inventory');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}