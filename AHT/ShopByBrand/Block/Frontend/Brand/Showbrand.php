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
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\ShopByBrand\Model\BrandFactory $brandFactory,
        ScopeConfigInterface  $scopeConfig,
        array $data = []
    ) {
        $this->brandFactory = $brandFactory;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
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
}
