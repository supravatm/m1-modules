<?php
class Bluehorse_Testimonial_Block_Adminhtml_Testimonial_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
		parent::__construct();
		
        $this->_objectId = 'testimonial_id';
		$this->_blockGroup = 'testimonial';
        $this->_controller = 'adminhtml_testimonial';

		
		/*$this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('testimonial')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
		        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
*/
  }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if(Mage::registry('testimonial_data')->getId() ) {
            return Mage::helper('testimonial')->__('Edit Testimonial');
        } else {
            return Mage::helper('testimonial')->__('Add Testimonial');
        }
    }
}
