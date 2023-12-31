<?php

/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Auto Add Promo Items
*/
class Amasty_Promo_Block_Notification extends Mage_Core_Block_Template
{
    /**
     * @return mixed
     */
    public function getMessage()
    {
        $pattern = Mage::getStoreConfig('ampromo/messages/notification_text');
        
        /** @var Amasty_Promo_Helper_Data $helper */
        $helper = Mage::helper('ampromo');
        
        $message = $helper->processPattern($pattern);

        return $message;
    }
}
