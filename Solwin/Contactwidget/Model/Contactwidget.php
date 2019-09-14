<?php
namespace Solwin\Contactwidget\Model;

class Contactwidget extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Solwin\Contactwidget\Model\ResourceModel\Contactwidget');
    }
}
?>