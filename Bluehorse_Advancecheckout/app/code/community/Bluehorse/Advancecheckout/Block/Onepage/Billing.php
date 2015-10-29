<?php

class Bluehorse_Advancecheckout_Block_Onepage_Billing extends Mage_Checkout_Block_Onepage_Billing
{

    protected function _construct()
    {
        $this->getCheckout()->setStepData('billing', array(
            'label'     => Mage::helper('advancecheckout')->__('Shipping Information'),
            'is_show'   => $this->isShow()
        ));

        if ($this->isCustomerLoggedIn()) {
            $this->getCheckout()->setStepData('billing', 'allow', true);
        }
        Mage_Checkout_Block_Onepage_Abstract::_construct();
    }

}
