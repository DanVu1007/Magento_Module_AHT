<?php
namespace AHT\SelectCategory\Block\Adminhtml\Tab;
use Magento\Catalog\Block\Adminhtml\Form;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Categories extends Form implements TabInterface
{
    /**
     * @var \Magento\Framework\Data\FormFactory
     */
    private $formFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @var \Magento\Backend\Block\Template\Context
     */
    private $context;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $json;

    /**
     * @var \Magento\Catalog\Ui\Component\Product\Form\Categories\Options
     */
    private $categoryOptions;

    /**
     */
    public function __construct(
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Catalog\Ui\Component\Product\Form\Categories\Options $CategoryOptions,
        array $data = []
    ) {
        $this->formFactory = $formFactory;
        $this->registry = $registry;
        $this->context = $context;
        $this->json = $json;
        $this->categoryOptions = $CategoryOptions;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    public function getCategoriesTree()
    {
        $options = $this->categoryOptions->toOptionArray();
        return $this->json->serialize($options);
    }

     /**
     * Returns tab label
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Categories');
    }

    /**
     * Return Tab title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Categories');
    }

    /**
     * Can show tab in tabs
     *
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**ock
     * Tab not hidden
     *
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}
