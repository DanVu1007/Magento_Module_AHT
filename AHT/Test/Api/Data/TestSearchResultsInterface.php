<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Test\Api\Data;

interface TestSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Test list.
     * @return \AHT\Test\Api\Data\TestInterface[]
     */
    public function getItems();

    /**
     * Set test1 list.
     * @param \AHT\Test\Api\Data\TestInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
