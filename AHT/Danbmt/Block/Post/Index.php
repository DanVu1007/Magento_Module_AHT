<?php

namespace AHT\Danbmt\Block\Post;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \AHT\Danbmt\Model\ResourceModel\Post\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @param \AHT\Danbmt\Model\PostRepository
     */
    private $PostRepository;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Danbmt\Model\ResourceModel\Post\CollectionFactory $collectionFactory,
        \Magento\Framework\Registry $registry,
        \AHT\Danbmt\Model\PostRepository $PostRepository,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->registry = $registry;
        $this->PostRepository = $PostRepository;
        parent::__construct($context, $data);
    }
    public function getDanData()
    {
        return $this->collectionFactory->Create();
    }

    public function prepareEdit()
    {
        $id = $this->registry->registry('id');
        // var_dump($id);
        if($id != ''){
            $post = $this->PostRepository->get($id);
            return $post;
        }else{
            return null;
        }
    }
}
