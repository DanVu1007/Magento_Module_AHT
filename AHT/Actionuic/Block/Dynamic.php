<?php

namespace AHT\Actionuic\Block;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

class Dynamic  extends AbstractFieldArray
{
    protected function _prepareToRender()
    {
        $this->addColumn(
            'name',
            [
                'label' => __('Họ và tên'),
                'class' => 'required-entry'
            ]
        );
        $this->addColumn(
            'age',
            [
                'label' => __('Tuổi'),
                'class' => 'required-entry',
            ]
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Type');
    }
}
