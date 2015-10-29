<?php

class Bluehorse_Testimonial_Model_Testimonial extends Mage_Core_Model_Abstract
{

    /**
     * Internal constructor not depended on params. Can be used for object initialization
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('testimonial/testimonial');
    }

}
