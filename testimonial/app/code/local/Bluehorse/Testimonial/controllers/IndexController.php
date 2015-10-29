<?php
class Bluehorse_Testimonial_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
		$this->loadLayout();
        $this->renderLayout();
    }
	
	
   public function saveAction()
    {
		if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
					    $createdate=now();
			            $updatedate=now();
                 $Model = Mage::getModel('testimonial/testimonial');
                 $Model->setTestimonialText($postData['testimonial_text'])
				 	->setOrderId($postData['order_id'])
                    ->setTestimonialName($postData['name'])
					->setEmail($postData['email'])
					->setAddress($postData['address'])
					->setCountry($postData['country'])
					->setCreatedTime($createdate)
					->setUpdateTime($updatedate)
					->setStatus(2)
                    ->save();
               
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Testimonial was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setTestimonialData(false);
 
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setTestimonialData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    } 

	
}
