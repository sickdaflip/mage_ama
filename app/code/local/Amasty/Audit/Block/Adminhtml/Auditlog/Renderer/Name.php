<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Admin Actions Log
*/

class Amasty_Audit_Block_Adminhtml_Auditlog_Renderer_Name extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    
   public function render(Varien_Object $row)
   {
       if(!$row->getInfo()) {
             $row->setInfo("—");
       }
       return $row->getInfo();
   }
}
