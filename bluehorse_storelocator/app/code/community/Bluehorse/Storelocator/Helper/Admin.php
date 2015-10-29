<?php
/**
 * Store locator admin helper
 * 
 * @category    Bluehorse
 * @package     Bluehorse_Storelocator
 * @author      Bluehorse Magento Team
 */
class Bluehorse_Storelocator_Helper_Admin extends Mage_Core_Helper_Abstract
{
    /**
     * Check permission for passed action
     *
     * @param string $action
     * @return bool
     */
    public function isActionAllowed($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('bluehorse_storelocator/bluehorse_manage_storelocator/' . $action);
    }
}
