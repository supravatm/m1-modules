<?php
/**
 * Import edit form block
 * 
 * @category    Bluehorse
 * @package     Bluehorse_Storelocator
 * @author      Bluehorse Magento Team
 */
class Bluehorse_Storelocator_Block_Adminhtml_Import_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Add fieldset
     *
     * @return Bluehorse_Storelocator_Block_Adminhtml_Import_Edit_Form
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/save'),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => Mage::helper('bluehorse_storelocator')->__('Import Settings')));
        
        $fieldset->addField('behavior', 'select', array(
            'name'     => 'behavior',
            'title'    => Mage::helper('bluehorse_storelocator')->__('Overwrite existing store(s)'),
            'label'    => Mage::helper('bluehorse_storelocator')->__('Overwrite existing store(s)'),
            'required' => true,
            'values'   => Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray(),
            'value'   => 1,
        ));
        
        $fieldset->addField('import_file', 'file', array(
            'name'     => 'import_file',
            'label'    => Mage::helper('bluehorse_storelocator')->__('Select File to Import'),
            'title'    => Mage::helper('bluehorse_storelocator')->__('Select File to Import'),
            'required' => true
        ));

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
