<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AHT\Blog\Model\ResourceModel\Blog\Grid;

// use AHT\Blog\Model\ResourceModel\Blog;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Locale\ResolverInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;

/**
 * Collection to present grid of customers on admin area
 */
class Collection extends SearchResult
{
    /**
     * @var ResolverInterface
     */
    private $localeResolver;

    /**
     * @inheritdoc
     */
    protected $document = Document::class;

    /**
     * @inheritdoc
     */
    protected $_map = ['fields' => ['blog' => 'blog.blog_id']];

    /**
     * @param EntityFactory $entityFactory
     * @param Logger $logger
     * @param FetchStrategy $fetchStrategy
     * @param EventManager $eventManager
     * @param ResolverInterface $localeResolver
     * @param string $mainTable
     * @param string $resourceModel
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        ResolverInterface $localeResolver,
        $mainTable = 'blog',
        $resourceModel = Customer::class
    ) {
        $this->localeResolver = $localeResolver;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }
}
