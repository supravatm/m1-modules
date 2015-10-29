<?php
/**
 * Store renderer block
 * 
 * @category    Bluehorse
 * @package     Bluehorse_Storelocator
 * @author      Bluehorse Magento Team 
 * 
 */
 
class Bluehorse_Storelocator_Block_Adminhtml_Storelocator_Renderer_Store extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Renders store column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row)
    {
        $storeCode = array();
        
        if($row->getData($this->getColumn()->getIndex())==""){
            return "";
        }
        else{
            $storeIds =  $row->getData($this->getColumn()->getIndex());
            
            if(!is_array($storeIds)){
                $storeIds = array($storeIds);
            }
            
            if(!empty($storeIds)){
                foreach($storeIds as $storeId){
                    $storeCode[] = Mage::getModel('core/store')->load($storeId)->getCode();
                }
            }
            
            return implode(",", $storeCode);
        }
    }
}
