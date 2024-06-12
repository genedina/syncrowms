<?php
namespace Dnp\Syncrowms\Controller\Adminhtml\Log;

use Dnp\Syncrowms\Model\ResourceModel\Log\CollectionFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;



class MassDelete extends \Magento\Backend\App\Action
{
    protected $filter;
    protected $collectionFactory;
    protected $config;
    protected $_file;

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }


    /**
     * @return mixed
     */
    public function execute()
    {
        $CustomData = $this->collectionFactory->create();
        foreach ($CustomData as $value) {
            $templateId[] = $value['id'];
        }
        $parameterData = $this->getRequest()->getParams('id');
        $selectedAppsid = $this->getRequest()->getParams('id');
        if (array_key_exists("selected", $parameterData)) {
            $selectedAppsid = $parameterData['selected'];
        }
        if (array_key_exists("excluded", $parameterData)) {
            if ($parameterData['excluded'] == 'false') {
                $selectedAppsid = $templateId;
            } else {
                $selectedAppsid = array_diff($templateId, $parameterData['excluded']);
            }
        }
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('id', ['in' => $selectedAppsid]);
        $delete = 0;
        foreach ($collection as $item) {
            $item->delete();
            $delete++;
        }
        $this->messageManager->addSuccess(__('A total of %1 Records have been deleted.', $delete));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }

}
