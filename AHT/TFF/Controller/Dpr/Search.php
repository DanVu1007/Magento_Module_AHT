<?php
namespace AHT\TFF\Controller\Dpr;

class Search extends \Magento\Framework\App\Action\Action
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
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $json;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    private $productCollectionFactory;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    private $image;

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
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Helper\Image $image,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->jsonFactory = $jsonFactory;
        $this->json = $json;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->image = $image;
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
        return $resultJson->setData($this->getProductCollection());
    }

    public function getProductCollection(){
        $getPostData = $this->getRequest()->getContent();
        $respone = $this->json->unserialize($getPostData);

        $search_keyword = $respone['search_keyword'];
        echo '<pre>';
        print_r($search_keyword);
        echo '</pre>';
        exit();
        if($search_keyword == null) return false;

        $productCollection = $this->productCollectionFactory->create()
                                    ->addAttributeToSelect('*')
                                    ->addAttributeToFilter(
                                        array(
                                            'name', ['like' => '%'.$search_keyword.'%'],
                                            'sku', ['like' => '%'.$search_keyword.'%']
                                        )
                                    );
        foreach ($productCollection as $product) {
            $product['img_thumb'] = $this->image->init($product, 'product_thumbnail_image')->getUrl();
        }
        echo '<pre>';
        print_r($productCollection);
        echo '</pre>';
        exit();
        return [
            'product' => $productCollection->toArray(),
            'currency' => $this->priceCurrency->getCurrencySymbol()
        ];

    }
}
