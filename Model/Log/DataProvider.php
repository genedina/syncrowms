<?php

namespace Dnp\Syncrowms\Model\Log;

use Dnp\Syncrowms\Model\ResourceModel\Log\CollectionFactory;


class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData;
    protected $_customerRepositoryInterface;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $CollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $CollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $CollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        if(isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        $this->loadedData = array();

        foreach ($items as $item) {
            $id = $item->getId();
            $this->loadedData[$id]['fields'] = $item->getData();
        }

        return $this->loadedData;
    }
}
