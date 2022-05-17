<?php

namespace AHT\Portfolio\Controller\Adminhtml\Post;

use AHT\Portfolio\Model\PostFactory;
use Magento\Backend\App\Action;

/**
 * Class Save
 * @package AHT\Portfolio\Controller\Adminhtml\Post
 */
class Save extends Action
{
    /**
     * @var PostFactory
     */
    private $postFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param PostFactory $postFactory
     */
    public function __construct(
        Action\Context $context,
        PostFactory $postFactory
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['danPort_id']) ? $data['danPort_id'] : null;

        $newData = [
            'name' => $data['name'],
            'content' => $data['content'],
        ];

        $post = $this->postFactory->create();

        if ($id) {
            $post->load($id);
        }
        try {
            $post->addData($newData);
            $post->save();
            $this->messageManager->addSuccessMessage(__('You saved the post.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        return $this->resultRedirectFactory->create()->setPath('dan/post/index');
    }
}
 