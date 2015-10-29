<?php
class Bluehorse_Advancecheckout_Block_Onepage_Payment extends Mage_Checkout_Block_Onepage_Payment 
{
    protected function _construct()
    {
        $this->getCheckout()->setStepData('payment', array(
            'label'     => $this->__('Payment Option'),
            'is_show'   => $this->isShow()
        ));
        Mage_Checkout_Block_Onepage_Abstract::_construct();
    }

    /**
     * Getter
     *
     * @return float
     */
    public function getQuoteBaseGrandTotal()
    {
        return (float)$this->getQuote()->getBaseGrandTotal();
    }
}
