<?php
/**
 * Storelocation model
 * 
 * @category    Bluehorse
 * @package     Bluehorse_Storelocator
 * @author      Bluehorse Magento Team
 * 
 */
class Bluehorse_Storelocator_Model_Storelocator extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('bluehorse_storelocator/storelocator');
    }
    
    /**
     * Check if store exists based on its name
     *
     * @param $storeName store name
     * @param $storelocatorId storelocator id
     * @return boolean
     */
    public function storeExists($storeName, $storelocatorId = null)
    {
        $result = $this->_getResource()->storeExists($storeName, $storelocatorId);
        return (is_array($result) && count($result) > 0) ? true : false;
    }
    
    /**
     * Upload store csv file and import data from it
     *
     * @throws Mage_Core_Exception
     * @param Varien_Object $object
     * @return Bluehorse_Storelocator_Model_Storelocator
     */
    public function uploadAndImport($object)
    {
         $resultObj = $this->_getResource()->uploadAndImport($object);
         if($resultObj){
             return $resultObj;
         }
    }
    
}
