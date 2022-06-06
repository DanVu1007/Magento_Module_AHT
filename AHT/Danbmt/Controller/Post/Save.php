<?php

namespace AHT\Danbmt\Controller\Post;

class Save extends \Magento\Framework\App\Action\Action implements \AHT\Danbmt\Api\Data\PostInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \AHT\Danbmt\Model\PostFactory
     */
    private $post;

    /**
     * @param \AHT\Danbmt\Model\PostRepository
     */
    private $danPostRepository;

    /**
     * @param Magento\Framework\App\Cache\TypeListInterface
     */
    private $typeList;

    /**
     * @param Magento\Framework\App\Cache\Frontend\Pool
     */
    private $pool;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Danbmt\Model\PostFactory $post,
        \AHT\Danbmt\Model\PostRepository $danPostRepository,
        \Magento\Framework\App\Cache\TypeListInterface $typeList,
        \Magento\Framework\App\Cache\Frontend\Pool $pool
    ) {
        $this->_pageFactory = $pageFactory;
        $this->post = $post;
        $this->danPostRepository = $danPostRepository;
        $this->typeList = $typeList;
        $this->pool = $pool;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $request = $this->_request->getPostValue();

        extract($request);

        $post = $this->post->create();

        $post->setName($name);
        $post->setContent($content);

        if (isset($dan_id)) {
            $post->setDan_id($dan_id);
        }

        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);

        if ($this->danPostRepository->save($post)) {
            $this->flushCache();
            return $this->resultRedirectFactory->create()->setPath('danbmt/post');
        } else {
            $this->flushCache();
            return $this->resultRedirectFactory->create()->setPath('danbmt/post/edit');
        }
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
            $this->typeList->cleanType($type);
        }
        foreach ($this->pool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
    }
}
