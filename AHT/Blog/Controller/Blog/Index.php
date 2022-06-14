<?php

namespace AHT\Blog\Controller\Blog;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;
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
        $content = 'Show all blogs';

        $param          = $this->getRequest()->getParams();
        $cateId         = $this->getRequest()->getParam('cateid');
        $nameResearch   = $this->getRequest()->getParam('namesearch');

        if ($cateId != '') {
            $content  = "Show all blogs by category id: " . $cateId;
        }

        if ($nameResearch != '') {
            $content        = 'Show all blogs by name like: ' . $nameResearch;
            if ($cateId != '') {
                $content    = $content . ", and categoryid is: " . $param['cateid'];
            }
        }

        $pageResult->getConfig()->getTitle()->set(__($content));
        
        return $pageResult;
    }

    
}
