<?php

class Bluehorse_Testimonial_Block_Adminhtml_Testimonial_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	 public function __construct()
    {
        parent::__construct();
        $this->setId('testimonial_form');
        $this->setTitle(Mage::helper('testimonial')->__('Testimonial Information'));
    }
	
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
	
		protected function _prepareForm()
    {
		$model = Mage::registry('testimonial_data'); 
		$form = new Varien_Data_Form( array('id' => 'edit_form', 'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))), 'method' => 'post'));

		//$fieldset = $form->addFieldset('testimonial_form', array('legend'=>Mage::helper('testimonial')->__('Testimonial information')));
		
		$form->setHtmlIdPrefix('testimonial_');

        $fieldset = $form->addFieldset('testimonial_form', array('legend'=>Mage::helper('testimonial')->__('General Information'), 'class' => 'fieldset-wide'));

       
        $fieldset->addField('testimonial_name', 'text', array(
            'name'      => 'testimonial_name',
            'label'     => Mage::helper('testimonial')->__('Title'),
            'style'     => 'width:100px !important',
        ));
		$fieldset->addField('order_id', 'text', array(
            'name'      => 'order_id',
            'label'     => Mage::helper('testimonial')->__('Order ID'),
            'style'     => 'width:100px !important',
        ));

   $fieldset->addField('testimonial_text', 'editor', array(
            'name'      => 'testimonial_text',
            'label'     => Mage::helper('testimonial')->__('Comment'),
            'title'     => Mage::helper('testimonial')->__('Text'),
            'style'     => 'width:600px;',
            'required'  => true,
			'wysiwyg' => true,
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig()
        ));

        $fieldset->addField('country', 'text', array(
            'name'      => 'country',
            'label'     => Mage::helper('testimonial')->__('Country'),
            'style'     => 'width:100px !important',
        ));

       $fieldset->addField('email', 'text', array(
            'name'      => 'email',
            'label'     => Mage::helper('testimonial')->__('Email Id'),
            'style'     => 'width:100px !important',
        ));
		
		$fieldset->addField('address', 'text', array(
            'name'      => 'address',
            'label'     => Mage::helper('testimonial')->__('address'),
            'style'     => 'width:100px !important',
        ));

        $fieldset->addField('status', 'select', array(
			  'label'     => Mage::helper('testimonial')->__('Status'),
			  'name'      => 'status',
			  'values'    => array(
				  array(
					  'value'     => 1,
					  'label'     => Mage::helper('testimonial')->__('Enabled'),
				  ),

				  array(
					  'value'     => 2,
					  'label'     => Mage::helper('testimonial')->__('Disabled'),
				  ),
			  ),
			));
            $form->setValues($model->getData());
		$form->setUseContainer(true);
        $this->setForm($form);
	

      return parent::_prepareForm();
    }

}


