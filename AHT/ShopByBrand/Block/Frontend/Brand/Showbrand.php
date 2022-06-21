<?php

namespace AHT\ShopByBrand\Block\Frontend\Brand;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Showbrand extends \Magento\Framework\View\Element\Template
{
    const BRAND_ENABLE = "brand/showbrand/showbrand_enable";
    const CUSTOM_BRAND = "brand/show_custom/custom";

    const SHOW_ALL = 1;
    const SHOW_ONLY_NAME = 2;
    const SHOW_ONLY_IMAGE = 3;

    /**
     * @var \AHT\ShopByBrand\Model\BrandFactory
     */
    private $brandFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    private $productcollectionFactory;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    private $productFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(

        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\ShopByBrand\Model\BrandFactory $brandFactory,
        ScopeConfigInterface  $scopeConfig,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productcollectionFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        array $data = []
    ) {
        $this->brandFactory = $brandFactory;
        $this->scopeConfig = $scopeConfig;
        $this->productcollectionFactory = $productcollectionFactory;
        $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    public function showBrandDetail()
    {
        $id = $this->getRequest()->getParam('id');
        $brand = $this->brandFactory->create();
        if($id != null){
            $brand = $brand->load($id);
        }else{
            // redirect
        }
        return $brand;
    }


    public function showBrandByProductID($product_id)
    {
        $brand = 1;
        //Get product by $product_id;

        //Get attribute: brand_id

        //$brand -> getbrand by ID

        //Filter get all;
        $enable = $this->scopeConfig->getValue(self::BRAND_ENABLE, ScopeInterface::SCOPE_STORE);
        $customBrand = $this->scopeConfig->getValue(self::CUSTOM_BRAND, ScopeInterface::SCOPE_STORE);
        //Filter get only name

        //Filter get only image
        return $brand;
    }

    public function getProductsByBrandId(){
        $id = $this->getRequest()->getParam('id');
        $product = $this->productcollectionFactory->create();
        if($id != null){
            $product = $product->addAttributeToFilter('brand', $id)->load()->getAllIds();
        }

        foreach ($product as $value) {
            $products = $this->productFactory->create()->getById($value);
            echo '<pre>';
            print_r($products);
            echo '</pre>';
            // exit();
        }

        return $product;
    }

}
