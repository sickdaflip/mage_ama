<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */

/**
 * Class Amasty_Acart_Block_Adminhtml_Notifications
 */
class Amasty_Acart_Block_Adminhtml_Notifications extends Mage_Adminhtml_Block_Template
{
    /**
     * @return bool
     */
    public function canShow()
    {
        return Mage::helper('amacart')->isDebugMode();
    }

    /**
     * @return string
     */
    public function getSecurityAdminUrl()
    {
        return Mage::helper("adminhtml")->getUrl('adminhtml/system_config/edit/section/amacart');
    }
}
