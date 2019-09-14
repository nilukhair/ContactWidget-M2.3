<?php
namespace Solwin\Contactwidget\Block\Adminhtml\Contactwidget\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('contactwidget_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Contactwidget Information'));
    }
}