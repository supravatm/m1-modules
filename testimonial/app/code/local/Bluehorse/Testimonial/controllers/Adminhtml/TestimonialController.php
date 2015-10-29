<?php
class Bluehorse_Testimonial_Adminhtml_TestimonialController extends Mage_Adminhtml_Controller_Action
{
    /**
     * View grid action
     */
   public function indexAction() {
	$this->loadLayout();
    $this->_addContent($this->getLayout()->createBlock('testimonial/adminhtml_testimonial'));
    $this->renderLayout();
    }

    public function editAction()
    {
		 $Id     = $this->getRequest()->getParam('id');
         $Model  = Mage::getModel('testimonial/testimonial')->load($Id );
        if ($Model->getId() || $Id  == 0) {
            Mage::register('testimonial_data', $Model);
            $this->loadLayout();
            $this->_addContent($this->getLayout()->createBlock('testimonial/adminhtml_testimonial_edit'));
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('testimonial')->__('Testimonial does not exist'));
            $this->_redirect('*/*/');
        }
    } 
	public function newAction()
	 {
		$this->_forward('edit');
	}
 
    public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
				 $id=$this->getRequest()->getParam('id');
				 $news = Mage::getModel('testimonial/testimonial')->load($id);
				 if(!$news->getCreatedTime()){
					    $createdate=now();
			            $updatedate=now();
					 }
				 else{
					    $createdate=$news->getCreatedTime();
			            $updatedate=now();
					 }
				$ImageExist=$news->getTestimonialImage();
				if (isset($_FILES['testimonial_image']['name']) and (file_exists($_FILES['testimonial_image']['tmp_name']))) {
				$uploader = new Varien_File_Uploader('testimonial_image');
				$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
				$uploader->setAllowRenameFiles(false);
				$uploader->setFilesDispersion(false);
				$path = Mage::getBaseDir('media') . DS;
				$uploader->save($path, $_FILES['testimonial_image']['name']);
				$postData['testimonial_image'] = $_FILES['testimonial_image']['name'];
				} else {
					if(isset($postData['testimonial_image']['delete']) && $postData['testimonial_image']['delete'] == 1) {
						$postData['testimonial_image'] = '';
					} else {
						$postData['testimonial_image']=$ImageExist;
					}
				}

                 $Model = Mage::getModel('testimonial/testimonial');
                 $Model->setId($id)
                    ->setTestimonialName($postData['testimonial_name'])
					->setTestimonialDesignation($postData['testimonial_designation'])
					->setTestimonialText($postData['testimonial_text'])
					->setTestimonialImage($postData['testimonial_image'])
					->setOrderId($postData['order_id'])
					->setEmail($postData['email'])
					->setAddress($postData['address'])
					->setCountry($postData['country'])
					->setCreatedTime($createdate)
					->setUpdateTime($updatedate)
                    ->setStatus($postData['status'])
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
   public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $Model = Mage::getModel('testimonial/testimonial');
               
                $Model->setId($this->getRequest()->getParam('id'))
                    ->delete();
                   
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Testimonial was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
	
	public function massDeleteAction() {
        $testimonialIds = $this->getRequest()->getParam('testimonial');
        if(!is_array($testimonialIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select testimonial(s)'));
        } else {
            try {
                foreach ($testimonialIds as $testimonialId) {
                    $testimonial = Mage::getModel('testimonial/testimonial')->load($testimonialId);
                    $testimonial->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($testimonialIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $testimonialIds = $this->getRequest()->getParam('testimonial');
        if(!is_array($testimonialIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select testimonial(s)'));
        } else {
            try {
                foreach ($testimonialIds as $testimonialId) {
                    $awards = Mage::getSingleton('testimonial/testimonial')
                        ->load($testimonialId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($testimonialIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

      public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('testimonial/adminhtml_testimonial_grid')->toHtml()
        );
    }
    public function exportCsvAction()
    {
        $fileName   = 'testimonial.csv';
        $content    = $this->getLayout()->createBlock('testimonial/adminhtml_testimonial_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'testimonial.xml';
        $content    = $this->getLayout()->createBlock('testimonial/adminhtml_testimonial_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }

}
