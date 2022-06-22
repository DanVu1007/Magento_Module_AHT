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
     * @var \Magento\Catalog\Helper\Image
     */
    private $image;

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
        \Magento\Catalog\Helper\Image $image,
        array $data = []
    ) {
        $this->brandFactory = $brandFactory;
        $this->scopeConfig = $scopeConfig;
        $this->productcollectionFactory = $productcollectionFactory;
        $this->productFactory = $productFactory;
        $this->image = $image;
        parent::__construct($context, $data);
    }

    public function showBrandDetail()
    {
        $id = $this->getRequest()->getParam('id');
        $brand = $this->brandFactory->create();
        if ($id != null) {
            $brand = $brand->load($id);
        } else {
            // redirect
        }
        return $brand;
    }


    public function showBrandByProductID()
    {
        $result = [];
        $id = $this->getRequest()->getParam('id');

        //Filter get all;
        $enable = $this->scopeConfig->getValue(self::BRAND_ENABLE, ScopeInterface::SCOPE_STORE);

        //Get attribute: brand_id
        $brand_id = $this->productFactory->create()->load($id)->getBrand();

        $brand = $this->brandFactory->create()->load($brand_id);
        if ($enable == 1) {
            //Get more filter
            $customBrand = $this->scopeConfig->getValue(self::CUSTOM_BRAND, ScopeInterface::SCOPE_STORE);

            //Filter get all
            if ($customBrand == self::SHOW_ALL) {
                array_push($result,['display'=>'showall']);
            }
            //Filter get only name
            if ($customBrand == self::SHOW_ONLY_NAME) {
                array_push($result,['display'=>'showname']);
                $brand->unsetData('image');
            }
            //Filter get only image
            if ($customBrand == self::SHOW_ONLY_IMAGE) {
                array_push($result,['display'=>'showimage']);
                $brand->unsetData('name');
            }
            array_push($result,$brand->getData());
        } else {
            $result = null;
        }
        return $result;
    }

    //SHOW LIST PRODUCT ON DETAIL BRAND
    public function getAllIdsByBrandId()
    {
        $id = $this->getRequest()->getParam('id');
        $product = $this->productcollectionFactory->create();
        if ($id != null) {
            $product = $product->addAttributeToFilter('brand', $id)->load()->getAllIds();
        }
        return $product;
    }

    public function getAllProduct()
    {
        $ids = $this->getAllIdsByBrandId();
        $product = $this->productFactory->create();
        $result = [];
        foreach ($ids as $key => $id) {
            $item = [];
            $name = $product->load($id)->getData('name');
            $image = $this->image->init($product->load($id), 'product_thumbnail_image')->getUrl();;
            $price = $product->load($id)->getData('price');
            $url = $product->load($id)->getData('url_key');
            array_push($item, $name, $image, $price, $url);
            array_push($result, $item);
        }
        return $result;
    }
}
