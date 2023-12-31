<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Auto Add Promo Items
*/

class Amasty_Promo_Model_Source_Validrules
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = array(
            0 => Mage::helper('ampromo')->__('Current Product Only'),
            1 => Mage::helper('ampromo')->__('Whole Shopping Cart Content')
        );

        return $options;
    }

}
