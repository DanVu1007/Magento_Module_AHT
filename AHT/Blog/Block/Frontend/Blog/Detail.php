<?php
namespace AHT\Blog\Block\Frontend\Blog;

class Detail extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \AHT\Blog\Model\BlogFactory
     */
    private $blogFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Blog\Model\BlogFactory $blogFactory,
        array $data = []
    ) {
        $this->blogFactory = $blogFactory;
        parent::__construct($context, $data);
    }

    public function getBlogByID(){
        $id = $this->getRequest()->getParam('blog_id',null);
        if ($id != null){
            $blogModel = $this->blogFactory->create();
            $blogModel->load($id, 'blog_id');
            return $blogModel;
        }else{
            echo 'chuyển trang';
            return null;
        }
    }
}
