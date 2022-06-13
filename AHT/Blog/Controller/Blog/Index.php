<?php
namespace AHT\Blog\Controller\Blog;

class Index extends \Magento\Framework\App\Action\Action
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
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $registry
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->registry = $registry;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $pageResult = $this->_pageFactory->create();
        $pageResult->getConfig()->getTitle()->set(__('Show all blogs'));
        $param = $this->getRequest()->getParams();
        if(!empty($param['cateid'])){
            $pageResult->getConfig()->getTitle()->set(__('Show all blogs by category'));
            $this->registry->register('cateid',$param['cateid']);
        }
        if(!empty($param['namesearch'])){
            $content = 'Show all blogs by name like: '.$param['namesearch'];
            $pageResult->getConfig()->getTitle()->set(__($content));
            $this->registry->register('namesearch',$param['namesearch']);
        }
        return $pageResult;
    }
}
