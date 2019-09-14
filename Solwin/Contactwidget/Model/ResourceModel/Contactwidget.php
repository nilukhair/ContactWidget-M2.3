<?php
namespace Solwin\Contactwidget\Model\ResourceModel;

class Contactwidget extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('solvin_contactwidget', 'contact_id');
    }
}
?>