<?php
$installer = $this;

$installer->startSetup();

$table = $installer->getTable('testimonial');
$installer->getConnection()->dropTable($table);
$installer->run("
    create table IF NOT EXISTS {$table} (
        testimonial_id int(11) unsigned not null auto_increment,
        testimonial_name varchar(50) default NULL,
		email varchar(50) default NULL,
		testimonial_designation varchar(50) default NULL,
		address varchar(200) default NULL,
		country varchar(200) default NULL,
		order_id int(50) unsigned default 0,
        testimonial_text text default NULL,
        testimonial_image varchar(128) default NULL,
	   `status` smallint(6) NOT NULL default '0',
	   `created_time` datetime NULL,
       `update_time` datetime NULL,
        PRIMARY KEY(testimonial_id)
    ) engine=InnoDB default charset=utf8;
");
$installer->endSetup();