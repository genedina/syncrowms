<?php

namespace Dnp\Syncrowms\Controller\Adminhtml\Log;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action implements HttpGetActionInterface
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    /**
     * Load the page defined in view/adminhtml/layout/log_index.xml
     *
     * @return Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Dnp_Syncrowms::log');
        $resultPage->addBreadcrumb(__('Log'), __('Log'));
        $resultPage->getConfig()->getTitle()->prepend(__('Lista Log'));

        return $resultPage;
    }
}