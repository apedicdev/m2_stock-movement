# m2_stock-movement
magento2 stock movement module
Requires Magento 2.2+ due to following bug https://github.com/magento/magento2/issues/4857

observing following events

	<event name="cataloginventory_stock_item_save_after">
        
    <event name="checkout_submit_all_after"> 
        
    <event name="cataloginventory_stock_revert_products_sale"> //todo
        
    <event name="sales_order_item_cancel"> //todo
    
    
the module will store in a separate table information about product (id,sku), current value, variance and which event triggered it (order, admin change, api //todo)
An admin grid is shown under Catalog menu

performance and improvents:
actually it seems magento doesn't provide an unique event for the stock movement so we have to observer different events. 

The event ```cataloginventory_stock_item_save_after``` is triggered only in the admin area. I believe the module would be simpler and faster if 1 single event could be observed.
        