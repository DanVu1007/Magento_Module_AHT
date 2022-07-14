<?php
namespace AHT\FastOrderPractice\Controller\Index;

class Search extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $json;

    /**
     * @var Magento\Framework\Controller\Result\JsonFactory
     */
    private $jsonFactory;

    /**
     * @var Magento\Catalog\Helper\Image
     */
    private $imageHelper;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    private $priceCurrency;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->json = $json;
        $this->jsonFactory = $jsonFactory;
        $this->imageHelper = $imageHelper;
        $this->collectionFactory = $collectionFactory;
        $this->priceCurrency = $priceCurrency;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        return $resultJson->setData($this->getCollection());
    }

    public function getCollection()
    {
        $data = $this->getRequest()->getContent();
        $response = $this->json->unserialize($data);

        $search_keyword = $response['search_keyword'];
        
        $products = $this->collectionFactory->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter(
                array(
                    array('attribute' => 'name', 'like' => '%' . $search_keyword . '%'),
                    array('attribute' => 'sku', 'like' => '%' . $search_keyword . '%')
                )
            )
            ->setPageSize(10)
            ->setCurPage(1);
        foreach ($products as $product) {
            $product['src'] = $this->imageHelper
                ->init($product, 'product_base_image')
                ->getUrl();
        }
        if ($search_keyword == null) {

            return false;
        }

        return [
            'products' => $products->toArray(),
            'currency' => $this->priceCurrency->getCurrencySymbol()
        ];
    }
}
