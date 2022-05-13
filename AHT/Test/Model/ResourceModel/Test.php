<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Test\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Test extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('aht_test_test', 'test_id');
    }
}
