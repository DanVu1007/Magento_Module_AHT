<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace AHT\Test\Block\Index;

class Index extends \Magento\Framework\View\Element\Template
{

    /**
     * @param \AHT\Test\Model\ResourceModel\Test\Collection
     */
    private $_testCollection;

    /**
     * @param \AHT\Test\Model\Test
     */

    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Test\Model\ResourceModel\Test\CollectionFactory $testCollection,
        \AHT\Test\Model\TestRepository $testRepository,
        array $data = []
    ) {
        $this->_testCollection = $testCollection;
        $this->testRepository = $testRepository;

        parent::__construct($context, $data);
    }

    public function getList()
    {
        return $this->_testCollection->create();
    }
}
