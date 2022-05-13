<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace AHT\Test\Model;

use AHT\Test\Api\Data\TestInterface;
use AHT\Test\Api\Data\TestInterfaceFactory;
use AHT\Test\Api\Data\TestSearchResultsInterfaceFactory;

use AHT\Test\Model\ResourceModel\Test as ResourceTest;
use AHT\Test\Model\ResourceModel\Test\CollectionFactory as TestCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class TestRepository
{

    /**
     * @var ResourceTest
     */
    protected $resource;

    /**
     * @var TestCollectionFactory
     */
    protected $testCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var TestInterfaceFactory
     */
    protected $testFactory;

    /**
     * @var Test
     */
    protected $searchResultsFactory;


    /**
     * @param ResourceTest $resource
     * @param TestInterfaceFactory $testFactory
     * @param TestCollectionFactory $testCollectionFactory
     * @param TestSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceTest $resource,
        TestInterfaceFactory $testFactory,
        TestCollectionFactory $testCollectionFactory,
        TestSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->testFactory = $testFactory;
        $this->testCollectionFactory = $testCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(\Magento\Framework\Model\AbstractModel $test)
    {
        try {
            $this->resource->save($test);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the test: %1',
                $exception->getMessage()
            ));
        }
        return $test;
    }


    /**
     * @inheritDoc
     */
    public function get($testId)
    {
        $test = $this->testFactory->create();
        $this->resource->load($test, $testId);
        if (!$test->getId()) {
            throw new NoSuchEntityException(__('Test with id "%1" does not exist.', $testId));
        }
        return $test;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->testCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(TestInterface $test)
    {
        try {
            $testModel = $this->testFactory->create();
            $this->resource->load($testModel, $test->getTestId());
            $this->resource->delete($testModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Test: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($testId)
    {
        return $this->delete($this->get($testId));
    }
}
