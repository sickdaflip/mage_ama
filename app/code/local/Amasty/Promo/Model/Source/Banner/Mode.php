<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Auto Add Promo Items
*/

class Amasty_Promo_Model_Source_Banner_Mode
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => Amasty_Promo_Block_Banner::MODE_PRODUCT,
                'label' => Mage::helper('ampromo')->__('Product')
            ),
            array(
                'value' => Amasty_Promo_Block_Banner::MODE_CART,
                'label' => Mage::helper('ampromo')->__('Cart')
            )
        );
    }
}