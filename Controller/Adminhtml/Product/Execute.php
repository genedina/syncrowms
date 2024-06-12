<?php

namespace Dnp\Syncrowms\Controller\Adminhtml\Product;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Dnp\Syncrowms\Helper\Data;
use Dnp\Syncrowms\Helper\Config;

class Execute extends Action
{
    protected $resultJsonFactory;
    protected $helper;
    protected $config;
    protected $stockItem;
    protected $_productRepository;

    public function __construct(
        Context $context,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\CatalogInventory\Api\StockStateInterface $stockItem,
        JsonFactory $resultJsonFactory,
        Data $helper,
        Config $config
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->helper = $helper;
        $this->config = $config;
        $this->_productRepository = $productRepository;
        $this->stockItem = $stockItem;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $productId = $this->getRequest()->getParam('product_id');

        if($this->config->isEnabled()):
            $params = [
                'sku'=>$productId,
                'product_type_id'=>'',
                'qty'=>'',
                'message'=>$this->config->messageError().': Product Id: '.$productId,
                'status'=>0
            ];
            $this->helper->logMessage($params);
            throw new \Exception($this->config->messageError().':'.$productId);
        endif;


        try {
            $product = $this->_productRepository->getById($productId);
            $sku     = $product->getSku();
            $typeId  = $product->getTypeId();
            $stock   = $product->getExtensionAttributes()->getStockItem()->getQty();
            $message = 'Action executed successfully for product ID: ' . $productId .' SKU:'.$sku.' Qty:'.$stock;
            $params = [
                'sku'=>$sku,
                'product_type_id'=>$typeId,
                'qty'=>$stock,
                'message'=>$message,
                'status'=>1
            ];
            $this->helper->logMessage($params);
            return $result->setData([
                'success' => true,
                'message' => $message
            ]);

        }catch (\Exception $error){
            $params = [
                'sku'=>$productId,
                'product_type_id'=>'',
                'qty'=>'',
                'message'=>$error->getMessage(),
                'status'=>0
            ];
            $this->helper->logMessage($params);
        }
    }
}