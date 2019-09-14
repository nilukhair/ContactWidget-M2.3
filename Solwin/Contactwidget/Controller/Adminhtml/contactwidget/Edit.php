<?php

namespace Solwin\Contactwidget\Controller\Adminhtml\contactwidget;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Solwin_Contactwidget::Contactwidget')
            ->addBreadcrumb(__('Solwin Contactwidget'), __('Solwin Contactwidget'))
            ->addBreadcrumb(__('Manage Item'), __('Manage Item'));
        return $resultPage;
    }

    /**
     * Edit Item
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('contact_id');
        $model = $this->_objectManager->create('Solwin\Contactwidget\Model\Contactwidget');

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This item no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        // 3. Set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        // 4. Register model to use later in blocks
        $this->_coreRegistry->register('contactwidget', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->setActiveMenu('Solwin_Contactwidget::contactwidget');
        $resultPage->addBreadcrumb(__('Solwin'), __('Solwin'));
        $resultPage->addBreadcrumb(
            $id ? __('Edit Item') : __('New Item'),
            $id ? __('Edit Item') : __('New Item')
        );
        $resultPage->getConfig()->getTitle()->prepend($id ? __('Edit Item') : __('New Item'));
        //$resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Item'));

        return $resultPage;
    }
}