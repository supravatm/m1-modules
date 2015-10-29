<?php
class Bluehorse_Advancecheckout_Block_Onepage extends Mage_Checkout_Block_Onepage 
{
	/* Remove Shipping and shipping method from checkout */
    protected function _getStepCodes()
    {
        if (!Mage::helper('advancecheckout')->getHideShipping()){
            return parent::_getStepCodes();
        }
        return array_diff(parent::_getStepCodes(), array('shipping_method','shipping'));
    }
}
