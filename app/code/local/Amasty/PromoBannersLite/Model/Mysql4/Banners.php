<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Banners Lite (System)
*/

class Amasty_PromoBannersLite_Model_Mysql4_Banners extends Mage_Core_Model_Mysql4_Abstract
{

    public function _construct()
    {
        $this->_init('ambannerslite/banners', 'ambanner_id');
    }

    public function getProducts($ruleId)
    {
        $read   = $this->_getReadAdapter();
        $tbl    = $this->getTable('ambannerslite/banners');
        $select = $read->select()->from($tbl, 'ambannerslite_banner_products')->where('rule_id = ?', $ruleId);

        $col = $read->fetchCol($select);

        return $col;
    }
}