<?php

class Bluehorse_Testimonial_Model_Status extends Mage_Core_Model_Abstract
{

    const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 0;
	static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED   => Mage::helper('testimonial')->__('Enabled'),
            self::STATUS_DISABLED    => Mage::helper('testimonial')->__('Disabled')
        );
    }

}
