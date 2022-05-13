<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Danbmt\Api\Data;

interface PostSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Post list.
     * @return \AHT\Danbmt\Api\Data\PostInterface[]
     */
    public function getItems();

    /**
     * Set dan list.
     * @param \AHT\Danbmt\Api\Data\PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
