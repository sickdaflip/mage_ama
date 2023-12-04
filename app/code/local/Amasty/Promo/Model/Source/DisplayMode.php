<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Auto Add Promo Items
*/

class Amasty_Promo_Model_Source_DisplayMode
{
    const MODE_POPUP = 0;
    const MODE_INLINE = 1;

    public function toOptionArray()
    {
        return array(
            array('value' => self::MODE_POPUP, 'label' => Mage::helper('ampromo')->__('Popup')),
            array('value' => self::MODE_INLINE, 'label' => Mage::helper('ampromo')->__('Inside Page')),
        );
    }
}
