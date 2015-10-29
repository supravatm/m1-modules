<?php

class Bh_Events_Block_Adminhtml_Details_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  
  protected function _prepareForm()
  {
	  $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('Details_form', array('legend'=>Mage::helper('events')->__('Details information')));
      $fieldset->addField('events_id', 'multiselect', array(
            'label'     => Mage::helper('events')->__('Chose Page(s)'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'events_id',
			'values' => Mage::getSingleton('events/details')->getEvents(),
        ));

     $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('events')->__('Title'),
			'class'     => 'required-entry',
			'required'  => true,

        ));
		
	 $fieldset->addField('short_description', 'textarea', array(
            'name'      => 'short_description',
            'label'     => Mage::helper('events')->__('Short Description'),
            'title'     => Mage::helper('events')->__('Short Description'),
			'style'     => 'width:600px;',
        ));
	
	
	  $fieldset->addField('description', 'editor', array(
            'name'      => 'description',
            'label'     => Mage::helper('events')->__('Description'),
            'title'     => Mage::helper('events')->__('Description'),
            'style'     => 'width:600px;',
			'wysiwyg' => true,
            'config'    => Mage::getSingleton('events/wysiwyg_config')->getConfig()
        ));
		
	  $fieldset->addField('image', 'image', array(
            'label'     => Mage::helper('events')->__('Image'),
            'name'      => 'image',
        ));
      $fieldset->addField('thumbnail', 'image', array(
            'label'     => Mage::helper('events')->__('Banner Image'),
            'name'      => 'thumbnail',
        ));
		
	  $fieldset->addField('video_url', 'text', array(
            'name'      => 'video_url',
            'label'     => Mage::helper('events')->__('Video Url'),
        ));
	
     $fieldset->addField('author_name', 'text', array(
            'name'      => 'author_name',
            'label'     => Mage::helper('events')->__('Author Name'),
        ));
	 $fieldset->addField('author_image', 'image', array(
            'label'     => Mage::helper('events')->__('Author Image'),
            'name'      => 'author_image',
        ));
     $fieldset->addField('published_place', 'text', array(
            'name'      => 'published_place',
            'label'     => Mage::helper('events')->__('Location'),
        ));
     $fieldset->addField('published_date', 'date', array(
          'label'     => Mage::helper('events')->__('Date'),
          'image' => $this->getSkinUrl('images/grid-cal.gif'),
          'format' => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
		  'name'      => 'published_date'
        ));
		
     $fieldset->addField('tag', 'text', array(
            'name'      => 'tag',
            'label'     => Mage::helper('events')->__('Tag'),
            'after_element_html' => '<br><small>Put "," between Tags(Example : tag1,tag2,tag3 .....)</small>'
        ));

		
     $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('events')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('events')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('events')->__('Disabled'),
              ),
          ),
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getDetailsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getDetailsData());
          Mage::getSingleton('adminhtml/session')->setDetailsData(null);
      } elseif ( Mage::registry('details_data') ) {
          $form->setValues(Mage::registry('details_data')->getData());
      }
      return parent::_prepareForm();
  }
  
  
}
