<?php

namespace AHT\ShopByBrand\Plugin\AddBrandItemData;

class AddBrandItemData
{
    /**
     * @var \Magento\Checkout\Model\Cart
     */
    private $cart;


    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    private $productFactory;

    /**
     * @var \AHT\ShopByBrand\Model\BrandFactory
     */
    private $brandFactory;

    public function __construct(
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \AHT\ShopByBrand\Model\BrandFactory $brandFactory
    ) {
        $this->cart = $cart;
        $this->productFactory = $productFactory;
        $this->brandFactory = $brandFactory;
    }

    public function afterGetConfig(\Magento\Checkout\Model\DefaultConfigProvider $item, $result)
    {
        $items = $result['totalsData']['items'];
        $quoteItem = $this->cart->getQuote();
        $product = $this->productFactory->create();
        $brand = $this->brandFactory->create();
        foreach ($items as $key => $item) {
            $productId = $quoteItem->getItemById($item['item_id'])->getProduct_id();
            $brandId = $product->load($productId)->getBrand();
            if($brandId){
                $result['totalsData']['items'][$key]['brand'] = $brand->load($brandId)->getName();
            }

        }
        return $result;
    }
}
