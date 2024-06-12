<?php

namespace Dnp\Syncrowms\Block\Adminhtml\Product;

use Magento\Backend\Block\Widget\Context;
use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Html\Link\Current;

class ProductButton extends \Magento\Backend\Block\Template
{
    protected $_template = 'Dnp_Syncrowms::product/wms_button.phtml';

    protected $context;

    public function __construct(
        Context $context
    ) {
        $this->context = $context;
        parent::__construct($context);
    }

    public function getAjaxUrl()
    {
        return $this->getUrl('dnp_syncrowms/product/execute');
    }
}