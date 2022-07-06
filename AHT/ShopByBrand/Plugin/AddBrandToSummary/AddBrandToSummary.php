<?php
namespace AHT\ShopByBrand\Plugin\AddBrandToSummary;

class AddBrandToSummary
{
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    private $productFactory;

    /**
     * @var \AHT\ShopByBrand\Model\BrandFactory
     */
    private $brandFactory;

    public function __construct(
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \AHT\ShopByBrand\Model\BrandFactory $brandFactory
    )
    {
        $this->productFactory = $productFactory;
        $this->brandFactory = $brandFactory;
        
    }

    public function afterToArray(\Magento\Quote\Model\Quote\Item $item, $result){
        $productId = $result['product_id'];
        $product = $this->productFactory->create()->load($productId);
        $brandId = $product->getBrand();
        $brand = $this->brandFactory->create()->load($brandId);
        return array_merge($result,['brand'=>$brand->getName()]);
    }
}
