<?php

/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace AHT\Actionuic\Controller\Adminhtml\Actionuic;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Framework\Event\ManagerInterface
     */
    private $eventManager;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Magento\Framework\Event\ManagerInterface $eventManager
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->eventManager = $eventManager;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('uic_id');

            $model = $this->_objectManager->create(\AHT\Actionuic\Model\Actionuic::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Actionuic no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);
            $this->eventManager->dispatch('event_change_name', ['totalData' => $model]);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Actionuic.'));
                $this->dataPersistor->clear('actionuic_actionuic');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['uic_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Actionuic.'));
            }

            $this->dataPersistor->set('actionuic_actionuic', $data);
            return $resultRedirect->setPath('*/*/edit', ['uic_id' => $this->getRequest()->getParam('uic_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
