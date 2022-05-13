<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace AHT\Test\Model;

use AHT\Test\Api\Data\TestInterface;
use Magento\Framework\Model\AbstractModel;

class Test extends AbstractModel
{
    const CACHE_TAG = 'mageplaza_helloworld_post';
    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\AHT\Test\Model\ResourceModel\Test::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
