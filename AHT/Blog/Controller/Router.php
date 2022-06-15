<?php

declare(strict_types=1);

namespace AHT\Blog\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;

/**
 * Class Router
 */
class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    private $actionFactory;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var \AHT\Blog\Model\BlogFactory
     */
    private $blogFactory;

    /**
     * @var \AHT\Blog\Model\BlogcategoryFactory
     */
    private $blogcategoryFactory;

    /**
     * @var \Magento\Framework\Controller\ResultFactory
     */
    private $resultFactory;

    /**
     * @var \Magento\Framework\App\Action\Context
     */
    private $actionContext;

    /**
     * Router constructor.
     *
     * @param ActionFactory $actionFactory
     * @param ResponseInterface $response
     */
    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response,
        \AHT\Blog\Model\BlogFactory $blogFactory,
        \AHT\Blog\Model\BlogcategoryFactory $blogcategoryFactory,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Framework\App\Action\Context $actionContext
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
        $this->blogFactory = $blogFactory;
        $this->blogcategoryFactory = $blogcategoryFactory;
        $this->resultFactory = $resultFactory;
        $this->actionContext = $actionContext;
    }

    /**
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public function match(RequestInterface $request): ?ActionInterface
    {
        $action = 'index';
        $idFilter = 'cateid';
        $linkGot = explode('/', trim($request->getPathInfo(), '/'));
        $id = '';

        if (!empty($linkGot[1])) {
            $identifier = explode('.', $linkGot[1])[0];
        } else {
            echo 'chuyen trang';
            die;
        }

        if ($linkGot[0] == 'blog') {
            $action = 'detail';
            $idFilter = 'blog_id';
            $id = $this->getIdBlogByUrl($identifier);
        }
        if ($linkGot[0] == 'category') {
            $id = $this->getIdCateByUrl($identifier);
        }


        if ($id != null) {
            $request->setModuleName('blog');
            $request->setControllerName('blog');
            $request->setActionName($action);
            $request->setParams([
                $idFilter => $id
            ]);
            return $this->actionFactory->create(Forward::class, ['request' => $request]);
        } else {
            echo 'chuyen trang';
            die;
        }
    }

    public function getIdBlogByUrl($url)
    {
        return $this->blogFactory->create()->load($url, 'url')->getBlog_id();
    }

    public function getIdCateByUrl($name)
    {
        return $this->blogcategoryFactory->create()->load($name, 'name')->getBlog_category_id();
    }

    public function redirectToUrl($url)
    {
        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($url);

        return $redirect;
    }
}
