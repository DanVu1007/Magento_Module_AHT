<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace AHT\Test\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Save implements HttpGetActionInterface, \Magento\Framework\App\Action\HttpPostActionInterface
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Framework\App\RequestInterface
     */
    private $request;

    /**
     * @param \AHT\Test\Model\Test
     */
    private $testFactory;

    /**
     * @param \AHT\Test\Model\TestRepository
     */
    private $testRepository;

    /**
     * @param \Magento\Framework\Controller\ResultFactory:
     */
    private $resultFactory;

    /**
     * @param Magento\Framework\App\Cache\TypeListInterface
     */
    private $cacheTypeList;

    /**
     * @param \Magento\Framework\App\Cache\Frontend\Pool
     */
    private $cacheFrontendPool;

    /**
     * Constructor
     *
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        PageFactory $resultPageFactory,
        \Magento\Framework\App\RequestInterface $request,
        \AHT\Test\Model\TestFactory $testFactory,
        \AHT\Test\Model\TestRepository $testRepository,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Framework\App\Cache\TypeListInterface $typeList,
        \Magento\Framework\App\Cache\Frontend\Pool $pool
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->request = $request;
        $this->testFactory = $testFactory;
        $this->testRepository = $testRepository;
        $this->resultFactory = $resultFactory;
        $this->cacheTypeList = $typeList;
        $this->cacheFrontendPool = $pool;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {


        $request =  ($this->request->getPostValue());
        extract($request);

        $test = $this->testFactory->create();

        $test->setName($name);
        $test->setDes($des);

        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);

        if ($this->testRepository->save($test)) {

            $redirect->setUrl('/hello/index/index');
        } else {
            $redirect->setUrl('/hello/index/create');
        }

        $this->flushCache();


        return $redirect;
    }

    public function flushCache()
    {
        $_types = [
            'config',
            'layout',
            'block_html',
            'collections',
            'reflection',
            'db_ddl',
            'eav',
            'config_integration',
            'config_integration_api',
            'full_page',
            'translate',
            'config_webservice'
        ];

        foreach ($_types as $type) {
            $this->cacheTypeList->cleanType($type);
        }
        foreach ($this->cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
    }
}
