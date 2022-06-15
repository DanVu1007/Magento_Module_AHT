<?php

namespace AHT\Blog\Block\Frontend\Blog;

use AHT\Blog\Model\Blog;
use AHT\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Index extends Template
{
    const STATUS_ENABLE = 1;
    /**
     * @param CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param Registry
     */
    private $registry;

    /**
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private $timezone;




    /**
     * @param \Magento\Framework\Controller\ResultFactory
     */
    private $resultFactory;

    /**
     * @param \Magento\Framework\App\Action\Context
     */
    private $actionContext;

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        Registry $registry,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Framework\App\Action\Context $actionContext,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->registry = $registry;
        $this->timezone = $timezone;
        $this->resultFactory = $resultFactory;
        $this->actionContext = $actionContext;
        parent::__construct($context, $data);
    }

    public function getCollectionBlog()
    {
        //get values of current page
        $page = ($this->getRequest()->getParam('p', 1));
        //get values of current limit
        $pageSize = ($this->getRequest()->getParam('limit', 5));
        //get current store date
        $date = $this->getDateTime();

        //get param and set
        $nameSearch = $this->getRequest()->getParam('namesearch');
        $cateId = $this->getRequest()->getParam('cateid');


        $collection = $this->collectionFactory->create()
            ->addFieldToFilter('status', Blog::STATUS_ENABLE)
            ->addFieldToFilter('public_day', ['lteq' => $date])
            ->setPageSize($pageSize)
            ->setCurPage($page);

        //Filter by name
        if ($nameSearch != null) {
            $addNameToSearch = ($cateId != null) ? 'main_table.name' : 'name';
            $collection->addFieldToFilter($addNameToSearch, ['like' => '%' . $nameSearch . '%']);
        }

        //Filter by category link
        if ($cateId != null) {
            $collection
                ->joinCollection('blog_category_connect', 'blog_id')
                ->joinCollection('blog_category', 'blog_category_id', false)
                ->addFieldToFilter('blog_category_connect.blog_category_id', $cateId)->getSelect()->group('main_table.blog_id');
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
        $collection = $this->getCollectionBlog();
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('My Pagination'));
        if ($collection) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'custom.history.pager'
            )->setAvailableLimit([5 => 5, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)->setCollection(
                    $collection
                );
            $this->setChild('pager', $pager);
            $collection->load();
        }
        return $this;
    }

    public function getDateTime()
    {
        return $this->timezone->date()->format('Y-m-d H:i:s');;
    }

    //Get blog by id
    public function getBlogByID()
    {
        $id = $this->getRequest()->getParam('blog_id');

        if ($id != null) {
            $collection = $this->collectionFactory->create()
                ->addFieldToFilter('blog_id', $id)
                ->addFieldToFilter('status', Blog::STATUS_ENABLE)
                ->addFieldToFilter('public_day', ['lteq' => $this->getDateTime()])
                ->getData();
            return $collection;
        } else {
            $this->redirectToHomePage('blog/blog/index');
        }
    }

    // redirect
    public function redirectToHomePage($url)
    {
        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl($url);
        return $redirect;
    }

    public function getBlogUrl($blog){
        return $this->getUrl('blog/'.$blog->getUrl().'.html');
    }

    
}
