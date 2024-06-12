<?php

namespace Dnp\Syncrowms\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Dnp\Syncrowms\Model\LogFactory;

class Data extends AbstractHelper
{
    protected $logFactory;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        LogFactory $logFactory
    ) {
        $this->logFactory = $logFactory;
        parent::__construct($context);

    }

    public function logMessage($params)
    {
        $log = $this->logFactory->create();
        $log->setSku($params['sku']);
        $log->setProductTypeId($params['product_type_id']);
        $log->setQty($params['qty']);
        $log->setMessage($params['message']);
        $log->setStatus($params['status']);
        $log->save();
    }

}