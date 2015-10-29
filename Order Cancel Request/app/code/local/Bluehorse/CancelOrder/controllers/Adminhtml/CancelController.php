<?php
/* @copyright   Copyright (c) 2015 BlueHorse */ 
class Bluehorse_CancelOrder_Adminhtml_CancelController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("cancelorder/cancel")->_addBreadcrumb(Mage::helper("adminhtml")->__("Cancel  Manager"),Mage::helper("adminhtml")->__("Cancel Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("CancelOrder"));
			    $this->_title($this->__("Manager Cancel"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("CancelOrder"));
				$this->_title($this->__("Cancel"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("cancelorder/cancel")->load($id);
				if ($model->getId()) {
					Mage::register("cancel_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("cancelorder/cancel");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Cancel Manager"), Mage::helper("adminhtml")->__("Cancel Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Cancel Description"), Mage::helper("adminhtml")->__("Cancel Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("cancelorder/adminhtml_cancel_edit"))->_addLeft($this->getLayout()->createBlock("cancelorder/adminhtml_cancel_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("cancelorder")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("CancelOrder"));
		$this->_title($this->__("Cancel"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("cancelorder/cancel")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("cancel_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("cancelorder/cancel");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Cancel Manager"), Mage::helper("adminhtml")->__("Cancel Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Cancel Description"), Mage::helper("adminhtml")->__("Cancel Description"));


		$this->_addContent($this->getLayout()->createBlock("cancelorder/adminhtml_cancel_edit"))->_addLeft($this->getLayout()->createBlock("cancelorder/adminhtml_cancel_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("cancelorder/cancel")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Cancel was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setCancelData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setCancelData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("cancelorder/cancel");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('cancel_req_ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("cancelorder/cancel");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'cancel.csv';
			$grid       = $this->getLayout()->createBlock('cancelorder/adminhtml_cancel_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'cancel.xml';
			$grid       = $this->getLayout()->createBlock('cancelorder/adminhtml_cancel_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
