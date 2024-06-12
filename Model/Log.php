<?php

namespace Dnp\Syncrowms\Model;

use Magento\Framework\Model\AbstractModel;

class Log extends AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'dnp_syncrowms_log';

    protected function _construct()
    {
        $this->_init(\Dnp\Syncrowms\Model\ResourceModel\Log::class);
    }


    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }
}