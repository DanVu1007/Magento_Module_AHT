<?php
namespace AHT\Danbmt\Controller\Post;

class Delete extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @param \AHT\Danbmt\Model\PostRepository
     */
    private $postRepository;

    /**
     * @param \Magento\Framework\App\Cache\TypeListInterface
     */
    private $typeList;

    /**
     * @param \Magento\Framework\App\Cache\Frontend\Pool
     */
    private $pool;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $registry,
        \AHT\Danbmt\Model\PostRepository $postRepository,
        \Magento\Framework\App\Cache\TypeListInterface $typeList,
        \Magento\Framework\App\Cache\Frontend\Pool $pool
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->registry = $registry;
        $this->postRepository = $postRepository;
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
        $id = $this->_request->getParam('id');
        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        if ($this->postRepository->deleteById($id)) {
            $redirect->setUrl('http://127.0.0.1/magentov2/danbmt/post/');
        } else {
            $redirect->setUrl('http://127.0.0.1/magentov2/danbmt/post/create');
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
            $this->typeList->cleanType($type);
        }
        foreach ($this->pool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
    }
}
