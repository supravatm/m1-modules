<?php

class Bh_Events_Block_Adminhtml_Details_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('details_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('events')->__('Details Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('events')->__('Details Information'),
          'title'     => Mage::helper('events')->__('Details Information'),
          'content'   => $this->getLayout()->createBlock('events/adminhtml_details_edit_tab_form')->toHtml(),
      ))
	  ->addTab('image_section', array(
          'label'     => Mage::helper('events')->__('Gallery Images'),
          'title'     => Mage::helper('events')->__('Gallery Images'),
          'content'   =>$this->getLayout()->createBlock('events/adminhtml_details_edit_tab_image')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}