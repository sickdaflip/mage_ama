<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */   
class Amasty_Acart_Block_Adminhtml_Blist extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_blist';
        $this->_blockGroup = 'amacart';
        $this->_headerText     = Mage::helper('amacart')->__('Black List');
        parent::__construct();
    }
}