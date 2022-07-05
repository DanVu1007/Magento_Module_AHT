<?php
namespace AHT\ShopByBrand\Plugin\BrandNameInMiniCart;
use Magento\Checkout\CustomerData\ItemPool;
class ShowBrandInMiniCart
{
    /**
     * @var \AHT\ShopByBrand\Model\BrandFactory
     */
    private $brandFactory;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    private $productFactory;

    public function __construct(
        \AHT\ShopByBrand\Model\BrandFactory $brandFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory
    )
    {
        $this->brandFactory = $brandFactory;
        $this->productFactory = $productFactory;

    }
    public function afterGetItemData(\Magento\Checkout\CustomerData\ItemPool $itemPool, $result)
    {
        $productId = $result['product_id'];
        $product = $this->productFactory->create()->load($productId);
        $brandId = $product->getBrand();
        $brand = $this->brandFactory->create()->load($brandId);
        return array_merge($result,['brand'=>$brand->getName()]);
    }


}