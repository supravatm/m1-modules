<?php
/* @copyright   Copyright (c) 2015 BlueHorse */ 
class Bluehorse_CancelOrder_Block_Adminhtml_Cancel extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_cancel";
	$this->_blockGroup = "cancelorder";
	$this->_headerText = Mage::helper("cancelorder")->__("Cancel Manager");
	//$this->_addButtonLabel = Mage::helper("cancelorder")->__("Add New Item");
	parent::__construct();
	$this->_removeButton('add');
	
	}

}