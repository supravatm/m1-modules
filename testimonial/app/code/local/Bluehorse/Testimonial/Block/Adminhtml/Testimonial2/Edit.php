<?php

class Bluehorse_Testimonial_Block_Adminhtml_Testimonial_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{   
protected function _prepareLayout() {
	
					if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
					$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
					$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
					if ($head = $this->getLayout()->getBlock('head')) {
						$head->addItem('js', 'prototype/window.js')
						->addItem('js_css', 'prototype/windows/themes/default.css')
						->addCss('lib/prototype/windows/themes/magento.css')
						->addItem('js', 'mage/adminhtml/variables.js');
					}
					return parent::_prepareLayout();


               }
}
 public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'testimonial_id';
        $this->_blockGroup = 'testimonial';
        $this->_controller = 'adminhtml_testimonial';
        
        $this->_updateButton('save', 'label', Mage::helper('testimonial')->__('Save Testimonial'));
        $this->_updateButton('delete', 'label', Mage::helper('testimonial')->__('Delete Testimonial'));
    }
	
	 public function getHeaderText()
    {
        if( Mage::registry('testimonial_data') && Mage::registry('testimonial_data')->getId() ) {
            return Mage::helper('testimonial')->__("Edit Testimonial", $this->htmlEscape(Mage::registry('testimonial_data')->getTitle()));
        } else {
            return Mage::helper('testimonial')->__('Add Testimonial');
        }
     }
}