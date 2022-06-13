<?php

namespace AHT\Blog\Block\Frontend\Blog;

class Index extends \Magento\Framework\View\Element\Template
{
    const STATUS_ENABLE = 1;
    /**
     * @param \AHT\Blog\Model\ResourceModel\Blog\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Blog\Model\ResourceModel\Blog\CollectionFactory $collectionFactory,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function getCollectionBlog()
    {
        //get values of current page
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        //get values of current limit
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 5;
        $date = date("Y-m-d h:i:s");

        //get param and set
        $param = $this->getRequest()->getParams();
        $namesearch = (!empty($param['namesearch'])) ? $param['namesearch'] : '';
        $cateid = (!empty($param['cateid'])) ? $param['cateid'] : '';

        $collection = $this->collectionFactory->create()
            ->addFieldToFilter('status', \AHT\Blog\Model\Blog::STATUS_ENABLE)
            ->addFieldToFilter('public_day', ['lteq' => $date])
            ->setPageSize($pageSize)
            ->setCurPage($page);

        //Filter by name
        if ($namesearch != '') {
            $addNameToSearch = ($cateid != '') ? 'main_table.name' : 'name';
            $collection->addFieldToFilter($addNameToSearch, ['like' => '%' . $this->registry->registry('namesearch') . '%']);
        }

        //Filter by category link
        if ($cateid != '') {
            $collection
                ->joinCollection('blog_category_connect', 'blog_id')
                ->joinCollection('blog_category', 'blog_category_id', false)
                ->addFieldToFilter('blog_category_connect.blog_category_id', $cateid)->getSelect()->group('main_table.blog_id');
        }

        return $collection;
    }


    //pagination
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('My Pagination'));
        if ($this->getCollectionBlog()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'custom.history.pager'
            )->setAvailableLimit([5 => 5, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)->setCollection(
                    $this->getCollectionBlog()
                );
            $this->setChild('pager', $pager);
            $this->getCollectionBlog()->load();
        }
        return $this;
    }
}
