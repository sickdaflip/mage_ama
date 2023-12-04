<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */
class Amasty_Acart_Block_Adminhtml_History_Grid_Renderer_Used extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $hlp =  Mage::helper('amacart'); 
        
        
        return $row->getTimesUsed() > 0 ? $hlp->__('Yes') : $hlp->__('No');

    }
}