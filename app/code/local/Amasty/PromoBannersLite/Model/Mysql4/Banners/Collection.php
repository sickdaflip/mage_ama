<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Banners Lite (System)
*/

class Amasty_PromoBannersLite_Model_Mysql4_Banners_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('ambannerslite/banners');
    }
}