<?php
$installer = $this;
$installer->startSetup();
$sql="
CREATE TABLE IF NOT EXISTS `order_cancel` (
  `cancel_req_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `status` smallint(6) NOT NULL,
  `request_date` datetime NOT NULL,
  PRIMARY KEY (`cancel_req_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
";

$installer->run($sql);
//demo 
//Mage::getModel('core/url_rewrite')->setId(null);
//demo 
$installer->endSetup();
	 