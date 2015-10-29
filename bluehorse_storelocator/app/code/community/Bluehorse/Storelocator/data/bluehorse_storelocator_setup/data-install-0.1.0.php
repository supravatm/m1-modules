<?php
/**
 * Storelocator data installation script
 * 
 * @category    Bluehorse
 * @package     Bluehorse_Storelocator
 * @author      Bluehorse Magento Team
 * 
 */
/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;
/**
 * Fill table bluehorse_storelocator/storelocator
 */

//Get current timestamp
$currentTimestamp = Mage::getModel('core/date')->timestamp(time());

$stores = array(
    array(
        'name'           => 'Lulu Shopping Mall, LuLu Mall',
        'status'         => 1,
        'street_address' =>'NH47, Nethaji Nagar, Edappally Ernakulam',
        'country'        =>'IN',
        'state'          =>'Kerala',
        'city'           =>'Kerala',
        'zipcode'        =>'682024',
        'phone'          =>'111-111-1111',
        'fax'            =>'1-111-111 1111',
        'url'            =>'http://www.magento.com',
        'email'          =>'test@gmail.com',
        'store_logo'     =>'demo1.png',
        'description'    =>'This is for testing.',
        'trading_hours'  =>'10AM-1PM 2PM-10PM',
        'radius'         =>'100',
        'latitude'       =>'10.027080',
        'longitude'      =>'76.308038',
        'zoom_level'     =>'6',
        'created_at'     =>$currentTimestamp
    ),
    array(
        'name'           => 'World Trade Park',
        'status'         => 1,
        'street_address' =>'J.L.N Marg,Malviya Nagar',
        'country'        =>'IN',
        'state'          =>'Rajasthan',
        'city'           =>'Jaipur',
        'zipcode'        =>'302017',
        'phone'          =>'0141 272 8044',
        'fax'            =>'1-111-111 1111',
        'url'            =>'http://www.magento.com',
        'email'          =>'test@gmail.com',
        'store_logo'     =>'demo1.png',
        'description'    =>'This is for testing.',
        'trading_hours'  =>'10AM-1PM 2PM-10PM',
        'radius'         =>'100',
        'latitude'       =>'26.853478',
        'longitude'      =>'75.805159',
        'zoom_level'     =>'6',
        'created_at'     =>$currentTimestamp
    ),
    array(
        'name'           => 'Phoenix Marketcity Mall',
        'status'         => 1,
        'street_address' =>'L.B.S. Marg, Kurla West, Opp. Naaz Hotel',
        'country'        =>'IN',
        'state'          =>'Maharashtra',
        'city'           =>'Mumbai',
        'zipcode'        =>'400070',
        'phone'          =>'022 6180 1100',
        'fax'            =>'1-111-111 1111',
        'url'            =>'http://www.magento.com',
        'email'          =>'test@gmail.com',
        'store_logo'     =>'demo1.png',
        'description'    =>'This is for testing.',
        'trading_hours'  =>'10AM-1PM 2PM-10PM',
        'radius'         =>'100',
        'latitude'       =>'19.086476',
        'longitude'      =>'72.888707',
        'zoom_level'     =>'6',
        'created_at'     =>$currentTimestamp
    ),
    array(
        'name'           => 'Elante Mall',
        'status'         => 1,
        'street_address' =>'Plot No. 178, Industrial Area, Phase 1',
        'country'        =>'IN',
        'state'          =>'Chandigarh',
        'city'           =>'Chandigarh',
        'zipcode'        =>'160017',
        'phone'          =>'0172 500 5000',
        'fax'            =>'1-111-111 1111',
        'url'            =>'http://www.magento.com',
        'email'          =>'test@gmail.com',
        'store_logo'     =>'demo1.png',
        'description'    =>'This is for testing.',
        'trading_hours'  =>'10AM-1PM 2PM-10PM',
        'radius'         =>'100',
        'latitude'       =>'30.705560',
        'longitude'      =>'76.801107',
        'zoom_level'     =>'6',
        'created_at'     =>$currentTimestamp
    )
);

/**
 * Insert data into storelocator table for testing/demo
 */
foreach ($stores as $data) {
    Mage::getModel('bluehorse_storelocator/storelocator')->setData($data)->save();
}

/**
 * Update table 'bluehorse_storelocator/storelocator_store' for multiple store view
 */

//test stores in the table 'bluehorse_storelocator/storelocator' 
$testStores = array('Lulu Shopping Mall, LuLu Mall', 'World Trade Park', 'Phoenix Marketcity Mall', 'Elante Mall');

foreach ($testStores as $testStore) {
    $testStorelocator = Mage::getModel('bluehorse_storelocator/storelocator')->load($testStore,'name');
    if ($testStorelocator->getId()) {
        $stores = $testStorelocator->getStores();
        if(empty($stores)){
            $testStorelocator->setStores(array(0))->save();
        }
    }
}
