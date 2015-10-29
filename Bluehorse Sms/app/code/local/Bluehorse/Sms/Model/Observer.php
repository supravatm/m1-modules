<?php

class Bluehorse_Sms_Model_Observer
{
	private function sendSms($param)
	{
		$request =""; //initialise the request variable 
		
        foreach($param as $key=>$val) {
        $request.= $key."=".urlencode($val);
        $request.= "&";
        }
        $request = substr($request, 0, strlen($request)-1);
        $url = "http://www.myvaluefirst.com/smpp/sendsms?".$request;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
	}
	
	public function verifySms(Varien_Event_Observer $observer)
	{
		$incrementId = $observer->getEvent()->getOrder()->getIncrementId();
		$custName = $observer->getEvent()->getOrder()->getCustomerFirstname();
		$orderPrice = $observer->getEvent()->getOrder()->getGrandTotal();
		$orderId = $observer->getEvent()->getOrder()->getId();
		$order = Mage::getModel('sales/order')->load($orderId);
		$mobile =  $order->getShippingAddress()->getData('telephone');
		$exMessage = Mage::getStoreConfig('bhsms/message/staticmsg');
		if($order->getPayment()->getMethodInstance()->getCode()=='phoenix_cashondelivery'){
			$paymentMethod = 'COD';
		}else{
			$paymentMethod = 'prepaid';
		}
		$param['username']	= Mage::getStoreConfig('bhsms/api/username');
		$param['password']	= Mage::getStoreConfig('bhsms/api/password');
		$param['to']		  = $mobile;
		$param['udh']		 = Mage::getStoreConfig('bhsms/api/udh');
		$param['from']		= Mage::getStoreConfig('bhsms/api/from');
		$param['text']		= "Hi ".$custName.", we have received your ".$paymentMethod." order #".$incrementId." for Rs.".$orderPrice.". ".$exMessage;
		// Hi Peter, we we have received your COD order #100000001 for Rs.400. MySite.
		$this->sendSms($param);
	}

	public function shipSms(Varien_Event_Observer $observer)
	{
		$incrementId = $observer->getEvent()->getShipment()->getOrder()->getIncrementId();
		$orderId = $observer->getEvent()->getShipment()->getOrder()->getId();
		$order = Mage::getModel('sales/order')->load($orderId);
		$mobile =  $order->getShippingAddress()->getData('telephone');
		$shipment = $observer->getEvent()->getShipment();
		$tracks = $shipment->getAllTracks();
		foreach($tracks as $track)
		{
			$trackingCode = $track->getNumber();
			$trackingTitle = $track->getTitle();
		}	
		$param['username']	= Mage::getStoreConfig('bhsms/api/username');
		$param['password']	= Mage::getStoreConfig('bhsms/api/password');
		$param['to']		  = $mobile;
		$param['udh']		 = Mage::getStoreConfig('bhsms/api/udh');
		$param['from']		= Mage::getStoreConfig('bhsms/api/from');
		$param['text']		= "Your shipment with tracking no. ".$trackingCode." will be delivered by our partner ".$trackingTitle.".";
		// Your shipment with tracking no. A98765X43210Z will be delivered by our partner DTDC.
		$this->sendSms($param);		
	}

	public function completeSms(Varien_Event_Observer $observer)
	{
		$incrementId = $observer->getOrder()->getIncrementId();
		$order = $observer->getOrder();
		if($order->getState() == Mage_Sales_Model_Order::STATE_COMPLETE){
			if($order->getStatus() == 'complete'){
			$mobile =  $order->getShippingAddress()->getData('telephone');
			$param['username']	= Mage::getStoreConfig('bhsms/api/username');
			$param['password']	= Mage::getStoreConfig('bhsms/api/password');
			$param['to']		  = $mobile;
			$param['udh']		 = Mage::getStoreConfig('bhsms/api/udh');
			$param['from']		= Mage::getStoreConfig('bhsms/api/from');
			$param['text']	  	= "Your shipment (Order#".$incrementId.") has been delivered. For any further queries write to us at info@mysite.com or call us at +91 99 99999999.";
			// Your shipment (Order#100000001) has been delivered. For any further queries write to us at info@mysite.com or call us at +91 99 99999999."
			$this->sendSms($param);	
			}
		}
	}

}