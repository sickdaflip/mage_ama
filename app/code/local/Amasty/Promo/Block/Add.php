<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Auto Add Promo Items
*/
class Amasty_Promo_Block_Add extends Mage_Core_Block_Template
{
    protected function _toHtml()
    {
        if (Mage::getStoreConfig('ampromo/popup/mode') == Amasty_Promo_Model_Source_DisplayMode::MODE_INLINE) {
            return false;
        }

        return parent::_toHtml();
    }
}
