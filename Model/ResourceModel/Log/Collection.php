<?php

namespace Dnp\Syncrowms\Model\ResourceModel\Log;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Dnp\Syncrowms\Model\Log as Model;
use Dnp\Syncrowms\Model\ResourceModel\Log as ResourceModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}