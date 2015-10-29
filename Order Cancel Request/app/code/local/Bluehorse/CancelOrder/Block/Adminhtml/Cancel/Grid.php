<?php
/* @copyright   Copyright (c) 2015 BlueHorse */ 
class Bluehorse_CancelOrder_Block_Adminhtml_Cancel_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("cancelGrid");
				$this->setDefaultSort("cancel_req_id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("cancelorder/cancel")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("cancel_req_id", array(
				"header" => Mage::helper("cancelorder")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "cancel_req_id",
				));
                
				$this->addColumn("order_id", array(
				"header" => Mage::helper("cancelorder")->__("Order ID"),
				"index" => "order_id",
				));
				$this->addColumn("name", array(
				"header" => Mage::helper("cancelorder")->__("Name"),
				"index" => "name",
				));
				$this->addColumn("email", array(
				"header" => Mage::helper("cancelorder")->__("Email ID"),
				"index" => "email",
				));
				$this->addColumn("phone", array(
				"header" => Mage::helper("cancelorder")->__("Phone No."),
				"index" => "phone",
				));
						$this->addColumn('status', array(
						'header' => Mage::helper('cancelorder')->__('Status'),
						'index' => 'status',
						'type' => 'options',
						'options'=>Bluehorse_CancelOrder_Block_Adminhtml_Cancel_Grid::getOptionArray6(),				
						));
						
				$this->addColumn("request_date", array(
				"header" => Mage::helper("cancelorder")->__("Request Date"),
				"index" => "request_date",
				));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('cancel_req_id');
			$this->getMassactionBlock()->setFormFieldName('cancel_req_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_cancel', array(
					 'label'=> Mage::helper('cancelorder')->__('Remove Cancel'),
					 'url'  => $this->getUrl('*/adminhtml_cancel/massRemove'),
					 'confirm' => Mage::helper('cancelorder')->__('Are you sure?')
				));
			return $this;
		}
			
		static public function getOptionArray6()
		{
            $data_array=array(); 
			$data_array[0]='Pending';
			$data_array[1]='Approved';
			$data_array[2]='Canceled';
            return($data_array);
		}
		static public function getValueArray6()
		{
            $data_array=array();
			foreach(Bluehorse_CancelOrder_Block_Adminhtml_Cancel_Grid::getOptionArray6() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}