<?php

namespace Dnp\Syncrowms\Helper;


class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_storeManager;
    protected $scopeConfig;
    protected $json;

    /**
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */

    public function __construct
    (
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Serialize\Serializer\Json $json
    )
    {
        $this->_storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->json = $json;
    }

    public function getConfig($path='')
    {
        if($path) return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $this->scopeConfig;
    }

    /**
     * @return \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public function isEnabled(){
        return $this->getConfig('syncro_wms/general/enabled');
    }

    /**
     * @return \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public function messageError(){
        return $this->getConfig('syncro_wms/general/error_message');
    }
}