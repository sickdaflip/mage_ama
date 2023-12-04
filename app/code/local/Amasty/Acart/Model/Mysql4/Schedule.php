<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */ 
class Amasty_Acart_Model_Mysql4_Schedule extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('amacart/schedule', 'schedule_id');
    }
    
}