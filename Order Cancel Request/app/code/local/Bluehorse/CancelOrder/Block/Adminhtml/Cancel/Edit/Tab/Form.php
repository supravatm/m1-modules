<?php
/* @copyright   Copyright (c) 2015 BlueHorse */ 
class Bluehorse_CancelOrder_Block_Adminhtml_Cancel_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("cancelorder_form", array("legend"=>Mage::helper("cancelorder")->__("Item information")));

				
						$fieldset->addField("order_id", "text", array(
						"label" => Mage::helper("cancelorder")->__("Order ID"),
						"name" => "order_id",
						));
					
						$fieldset->addField("name", "text", array(
						"label" => Mage::helper("cancelorder")->__("Name"),
						"name" => "name",
						));
					
						$fieldset->addField("email", "text", array(
						"label" => Mage::helper("cancelorder")->__("Email ID"),
						"name" => "email",
						));
					
						$fieldset->addField("phone", "text", array(
						"label" => Mage::helper("cancelorder")->__("Phone No."),
						"name" => "phone",
						));
					
						$fieldset->addField("reason", "textarea", array(
						"label" => Mage::helper("cancelorder")->__("Reason"),
						"name" => "reason",
						));
									
						 $fieldset->addField('status', 'select', array(
						'label'     => Mage::helper('cancelorder')->__('Status'),
						'values'   => Bluehorse_CancelOrder_Block_Adminhtml_Cancel_Grid::getValueArray6(),
						'name' => 'status',
						));
						$fieldset->addField("request_date", "text", array(
						"label" => Mage::helper("cancelorder")->__("Request Date"),
						"name" => "request_date",
						));
					

				if (Mage::getSingleton("adminhtml/session")->getCancelData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getCancelData());
					Mage::getSingleton("adminhtml/session")->setCancelData(null);
				} 
				elseif(Mage::registry("cancel_data")) {
				    $form->setValues(Mage::registry("cancel_data")->getData());
				}
				return parent::_prepareForm();
		}
}
