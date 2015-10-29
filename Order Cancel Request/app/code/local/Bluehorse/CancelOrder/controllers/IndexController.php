<?php
/* @copyright   Copyright (c) 2015 BlueHorse */ 
class Bluehorse_CancelOrder_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      $session = Mage::getSingleton('customer/session');
	  if ($session->isLoggedIn()) {
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Cancel"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("cancel", array(
                "label" => $this->__("Cancel"),
                "title" => $this->__("Cancel")
		   ));

	    $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('catalog/session');
      $this->renderLayout(); 
	  }else{
		Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
	  }
    }
	
	public function postAction()
    {
	  $session = Mage::getSingleton('customer/session');
	  if ($session->isLoggedIn()) {
		if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
				$createdate=now();
                 $Model = Mage::getModel('cancelorder/cancel');
                 $Model->setOrderId($postData['order_id'])
                    ->setName($postData['name'])
					->setEmail($postData['email'])
					->setPhone($postData['phone'])
					->setReason($postData['reason'])
					->setStatus(0)
					->setRequestDate($createdate)
                    ->save();
/* Send mail to Support */
$receiver = Mage::getStoreConfig('sales_email/order/copy_to');
$message = '<pre style="font-size:15px;">'.$postData['reason'].'<br><br>'.$postData['name'].'<br>Order ID : # '.$postData['order_id'].'<br>Phone : '.$postData['phone'].'<br>Email ID : '.$postData['email'].'</pre>';		
$mail = Mage::getModel('core/email');
$mail->setToName('Support');
$mail->setToEmail($receiver);
$mail->setBody($message);
$mail->setSubject('# '.$postData['order_id'].' Order Cancellation Request');
$mail->setFromEmail($postData['email']);
$mail->setFromName($postData['name']);
$mail->setType('html');
$mail->send();
/* Send mail to Support */

/* Send mail coy to Customer */
$customerEmail = $postData['email'];			
$copyMessage = '<pre style="font-size:15px;">
Dear '.$postData['name'].',<br>This email is for your reference only. You do not need to reply to this mail.<br>We will get back to you at the earliest.<br><br>Customer Support<br>--------------------<br>--------------------<br>
'.$postData['reason'].'</pre>';		
$mail = Mage::getModel('core/email');
$mail->setToName($postData['name']);
$mail->setToEmail($customerEmail);
$mail->setBody($copyMessage);
$mail->setSubject('# '.$postData['order_id'].' Order Cancellation Request');
$mail->setFromEmail('noreply@gmail.com');
$mail->setFromName('Support');
$mail->setType('html');
$mail->send();
/* Send mail coy to Customer */
				
 Mage::getSingleton('customer/session')->addSuccess(Mage::helper('cancelorder')->__('Order Cancellation Request was successfully send'));
// Mage::getSingleton('customer/session')->seReturnData(false);
                //$this->_redirect('*/*/');
		Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
                return;
            } catch (Exception $e) {
                Mage::getSingleton('customer/session')->addError($e->getMessage());
                Mage::getSingleton('customer/session')->setReturnData($this->getRequest()->getPost());
                $this->_redirect('*/*/', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
	  }else{
		Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
	  } 

    }

}