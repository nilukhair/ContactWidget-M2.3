<?php
namespace Solwin\Contactwidget\Block\Adminhtml\Contactwidget;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Solwin\Contactwidget\Model\contactwidgetFactory
     */
    protected $_contactwidgetFactory;

    /**
     * @var \Solwin\Contactwidget\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Solwin\Contactwidget\Model\contactwidgetFactory $contactwidgetFactory
     * @param \Solwin\Contactwidget\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Solwin\Contactwidget\Model\ContactwidgetFactory $ContactwidgetFactory,
        \Solwin\Contactwidget\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_contactwidgetFactory = $ContactwidgetFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('contact_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_contactwidgetFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'contact_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'contact_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


		
				$this->addColumn(
					'name',
					[
						'header' => __('Name'),
						'index' => 'name',
					]
				);
				
				$this->addColumn(
					'email',
					[
						'header' => __('Email'),
						'index' => 'email',
					]
				);
				
				$this->addColumn(
					'subject',
					[
						'header' => __('Subject'),
						'index' => 'subject',
					]
				);
				
				$this->addColumn(
					'store',
					[
						'header' => __('Store'),
						'index' => 'store',
					]
				);
				
				$this->addColumn(
					'order_date',
					[
						'header' => __('Order Date'),
						'index' => 'order_date',
						'type'      => 'datetime',
					]
				);
					
					
				$this->addColumn(
					'created_at',
					[
						'header' => __('CreatedAt'),
						'index' => 'created_at',
						'type'      => 'datetime',
					]
				);
					
					
						
						$this->addColumn(
							'order_type',
							[
								'header' => __('Order Type'),
								'index' => 'order_type',
								'type' => 'options',
								'options' => \Solwin\Contactwidget\Block\Adminhtml\Contactwidget\Grid::getOptionArray6()
							]
						);
						
						


		

		
		   $this->addExportType($this->getUrl('contactwidget/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('contactwidget/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('contact_id');
        //$this->getMassactionBlock()->setTemplate('Solwin_Contactwidget::contactwidget/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('contactwidget');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('contactwidget/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('contactwidget/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('contactwidget/*/index', ['_current' => true]);
    }

    /**
     * @param \Solwin\Contactwidget\Model\contactwidget|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		return '#';
    }

	
		static public function getOptionArray6()
		{
            $data_array=array(); 
			$data_array[0]='Prepaid';
			$data_array[1]='Postpaid';
            return($data_array);
		}
		static public function getValueArray6()
		{
            $data_array=array();
			foreach(\Solwin\Contactwidget\Block\Adminhtml\Contactwidget\Grid::getOptionArray6() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}