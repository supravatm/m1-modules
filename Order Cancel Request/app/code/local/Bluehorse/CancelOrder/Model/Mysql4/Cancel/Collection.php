<?php
/* @copyright   Copyright (c) 2015 BlueHorse */ 
    class Bluehorse_CancelOrder_Model_Mysql4_Cancel_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
    {
		public function _construct(){
			$this->_init("cancelorder/cancel");
		}
    }
	 