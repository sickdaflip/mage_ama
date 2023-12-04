<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Admin Actions Log
*/

class Amasty_Audit_Model_Mysql4_Visit_Detail_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('amaudit/visit_detail');
    }
}