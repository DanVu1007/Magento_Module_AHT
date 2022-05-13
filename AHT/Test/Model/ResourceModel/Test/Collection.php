<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Test\Model\ResourceModel\Test;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'test_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \AHT\Test\Model\Test::class,
            \AHT\Test\Model\ResourceModel\Test::class
        );
    }
}
