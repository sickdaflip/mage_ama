<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */
/**
 * @author Amasty
 */ 
class Amasty_Acart_Block_Adminhtml_Blist_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id'; 
        $this->_blockGroup = 'amacart';
        $this->_controller = 'adminhtml_blist';
    }

    public function getHeaderText()
    {
        return Mage::helper('amacart')->__('Blocked Recipient');
    }
}