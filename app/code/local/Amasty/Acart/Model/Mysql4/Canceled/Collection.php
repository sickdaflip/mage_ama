<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */
/**
 * @author Amasty
 */ 
class Amasty_Acart_Model_Mysql4_Canceled_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('amacart/canceled');
    }
      
}