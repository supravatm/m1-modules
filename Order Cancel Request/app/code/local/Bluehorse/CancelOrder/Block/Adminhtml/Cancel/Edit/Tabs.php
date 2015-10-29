<?php
/* @copyright   Copyright (c) 2015 BlueHorse */ 
class Bluehorse_CancelOrder_Block_Adminhtml_Cancel_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("cancel_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("cancelorder")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("cancelorder")->__("Item Information"),
				"title" => Mage::helper("cancelorder")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("cancelorder/adminhtml_cancel_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
