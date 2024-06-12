<?php

namespace Dnp\Syncrowms\Block;

class Log extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_log';
        $this->_blockGroup = 'Dnp_Syncrowms';
        $this->_headerText = __('Logs');
        parent::_construct();

    }
}