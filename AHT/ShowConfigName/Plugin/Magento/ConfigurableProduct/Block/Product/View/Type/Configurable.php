<?php
namespace AHT\ShowConfigName\Plugin\Magento\ConfigurableProduct\Block\Product\View\Type;

class Configurable
{
    public function afterGetJsonConfig(\Magento\ConfigurableProduct\Block\Product\View\Type\Configurable $subject, $result){
        $jsonResult = json_decode($result, true);
        echo '<pre>';
        print_r($jsonResult);
        echo '</pre>';
        // exit();
    }
}
