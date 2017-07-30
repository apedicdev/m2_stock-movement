<?php

namespace Apedic\Inventory\Controller\Adminhtml\Inventory;

use Magento\Backend\App\Action;

class Index extends Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;


    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Apedic_Inventory::stock_movement');
        $resultPage->addBreadcrumb(__('Apedic'), __('Apedic'));
        $resultPage->addBreadcrumb(__('Inventory'), __('stock'));
        // $resultPage->getConfig()->getTitle()->prepend(__(''));

        return $resultPage;
    }

    /*
	 * Check permission via ACL resource
	 */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Apedic_Inventory::stock_movement');
    }

}