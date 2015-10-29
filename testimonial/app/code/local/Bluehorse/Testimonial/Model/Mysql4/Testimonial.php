<?php
class Bluehorse_Testimonial_Model_Mysql4_Testimonial extends Mage_Core_Model_Mysql4_Abstract
{

    /**
     * Resource initialization
     */
    public function _construct()
    {
        $this->_init('testimonial/testimonial', 'testimonial_id');
    }

}
