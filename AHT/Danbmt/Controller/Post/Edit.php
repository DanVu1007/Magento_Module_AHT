<?php
namespace AHT\Danbmt\Controller\Post;

class Edit extends \Magento\Framework\App\Action\Action
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
        $id = $this->_request->getParam('id');
        $this->registry->register('id',$id);
        return $this->_pageFactory->create();
    }
}
