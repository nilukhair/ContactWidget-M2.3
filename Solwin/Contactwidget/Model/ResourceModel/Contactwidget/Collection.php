<?php

namespace Solwin\Contactwidget\Model\ResourceModel\Contactwidget;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Solwin\Contactwidget\Model\Contactwidget', 'Solwin\Contactwidget\Model\ResourceModel\Contactwidget');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>