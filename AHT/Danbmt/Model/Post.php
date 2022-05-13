<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Danbmt\Model;

use AHT\Danbmt\Api\Data\PostInterface;
use AHT\Danbmt\Api\Data\PostInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
class Post extends \Magento\Framework\Model\AbstractModel implements \AHT\Danbmt\Api\Data\PostInterface
{

    protected $postDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'aht_danbmt_post';
    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PostInterfaceFactory $postDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \AHT\Danbmt\Model\ResourceModel\Post $resource
     * @param \AHT\Danbmt\Model\ResourceModel\Post\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PostInterfaceFactory $postDataFactory,
        DataObjectHelper $dataObjectHelper,
        \AHT\Danbmt\Model\ResourceModel\Post $resource,
        \AHT\Danbmt\Model\ResourceModel\Post\Collection $resourceCollection,
        array $data = []
    ) {
        $this->postDataFactory = $postDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve post model with post data
     * @return PostInterface
     */
    public function getDataModel()
    {
        $postData = $this->getData();
        
        $postDataObject = $this->postDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $postDataObject,
            $postData,
            PostInterface::class
        );
        
        return $postDataObject;
    }

    public function getPostId(){

    }
    public function setPostId($postId){

    }
    public function getDan(){

    }
    public function setDan($dan){

    }
    public function getExtensionAttributes(){

    }


}