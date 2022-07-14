<?php
namespace AHT\TFF\Controller\Dpr;

class Add extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->jsonFactory = $jsonFactory;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $jsonData = $this->jsonFactory->create();
        $exampleArr = ['dan'=>1,'huy'=>'name'];
        return $jsonData->setData($exampleArr);
    }
}
