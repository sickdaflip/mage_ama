<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Admin Actions Log
*/ 
class Amasty_Audit_Model_Mysql4_Log_Details extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('amaudit/log_details', 'entity_id');
    }
}