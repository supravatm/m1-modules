<?php
/* @copyright   Copyright (c) 2015 BlueHorse */ 
class Bluehorse_CancelOrder_Model_Mysql4_Cancel extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("cancelorder/cancel", "cancel_req_id");
    }
}