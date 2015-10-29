<?php
require  Mage::getModuleDir('controllers', 'Mage_Checkout').DS.'OnepageController.php';
class Bluehorse_Advancecheckout_OnepageController extends Mage_Checkout_OnepageController
{
	
	   /**
     * Save checkout billing address
     */
    public function saveBillingAction()
    {
        if ($this->_expireAjax()) {
            return;
        }
        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost('billing', array());
            $customerAddressId = $this->getRequest()->getPost('billing_address_id', false);

            if (isset($data['email'])) {
                $data['email'] = trim($data['email']);
            }
            /* Use Billing as Shipping Address for all times */
           // $data['use_for_shipping'] =1;
            
            $result = $this->getOnepage()->saveBilling($data, $customerAddressId);

            if (!isset($result['error'])) {
                if ($this->getOnepage()->getQuote()->isVirtual()) {
                    $result['goto_section'] = 'payment';
                    $result['update_section'] = array(
                        'name' => 'payment-method',
                        'html' => $this->_getPaymentMethodsHtml()
                    );
                } elseif (isset($data['use_for_shipping']) && $data['use_for_shipping'] == 1) {
					
					
						$result = $this->getOnepage()->saveShippingMethod('freeshipping_freeshipping');
						// $result will contain error data if shipping method is empty
						if (!$result) {
							Mage::dispatchEvent(
								'checkout_controller_onepage_save_shipping_method',
								 array(
									  'request' => $this->getRequest(),
									  'quote'   => $this->getOnepage()->getQuote()));
							$this->getOnepage()->getQuote()->collectTotals();
							 $this->getOnepage()->getQuote()->collectTotals()->save();
							$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));

							$result['goto_section'] = 'payment';
							$result['update_section'] = array(
								'name' => 'payment-method',
								'html' => $this->_getPaymentMethodsHtml()
							);
						}					
					
    

                   // $result['allow_sections'] = array('payment');
                  //  $result['duplicateBillingInfo'] = 'true';
                }else {
                    $result['goto_section'] = 'payment-method';
                }
            }

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
        }
    }
	
	
 
}
