<?php
/* @copyright   Copyright (c) 2015 BlueHorse */ 
class Bluehorse_CancelOrder_Block_Adminhtml_Cancel_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "cancel_req_id";
				$this->_blockGroup = "cancelorder";
				$this->_controller = "adminhtml_cancel";
				//$this->_updateButton("save", "label", Mage::helper("cancelorder")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("cancelorder")->__("Delete Item"));
                $this->_removeButton('save');
/*				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("cancelorder")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);
*/


				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("cancel_data") && Mage::registry("cancel_data")->getId() ){

				    return Mage::helper("cancelorder")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("cancel_data")->getId()));

				} 
				else{

				     return Mage::helper("cancelorder")->__("Add Item");

				}
		}
}