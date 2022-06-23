<?php

namespace AHT\ShopByBrand\Block\Frontend\Brand;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class BrandInProduct extends \Magento\Framework\View\Element\Template
{
    const BRAND_ENABLE = "brand/showbrand/showbrand_enable";
    const CUSTOM_BRAND = "brand/show_custom/custom";

    const SHOW_ALL = 1;
    const SHOW_ONLY_NAME = 2;
    const SHOW_ONLY_IMAGE = 3;
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    private $productFactory;

    /**
     * @var \AHT\ShopByBrand\Model\BrandFactory
     */
    private $brandFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        ScopeConfigInterface  $scopeConfig,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \AHT\ShopByBrand\Model\BrandFactory $brandFactory,
        array $data = []
    ) {
        $this->productFactory = $productFactory;
        $this->brandFactory = $brandFactory;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function showBrandByProductID()
    {
        $brandId = $this->getBrandIdByProduct();
        $brand = $this->brandFactory->create()->load($brandId);
        return $brand;
    }

    public function isEnable(){
       return $this->scopeConfig->getValue(self::BRAND_ENABLE, ScopeInterface::SCOPE_STORE);
    }
    public function isShowAll()
    {
        return $this->getCustomBrand() == self::SHOW_ALL;
    }

    public function isShowImage()
    {
        return $this->getCustomBrand() == self::SHOW_ONLY_IMAGE;
    }

    public function isShowName()
    {
        return $this->getCustomBrand() == self::SHOW_ONLY_NAME;
    }

    public function getBrandIdByProduct(){
        $id = $this->getRequest()->getParam('id');
        $product = $this->productFactory->create()->load($id);
        return $product->getBrand();
    }
    public function getCustomBrand(){
        return  $this->scopeConfig->getValue(self::CUSTOM_BRAND, ScopeInterface::SCOPE_STORE);
    }
}


// * @var \Magento\Framework\Controller\Result\RedirectFactory
//     protected $resultRedirectFactory;
// return $this->resultRedirectFactory->create()->setPath('*/*/');