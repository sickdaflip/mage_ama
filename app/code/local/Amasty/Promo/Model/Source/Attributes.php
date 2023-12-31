<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Auto Add Promo Items
*/

class Amasty_Promo_Model_Source_Attributes
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = array();

        $collection = Mage::getResourceModel('eav/entity_attribute_collection')
            ->setItemObjectClass('catalog/resource_eav_attribute')
            ->setEntityTypeFilter(Mage::getResourceModel('catalog/product')->getTypeId())
            ->addFieldToFilter('frontend_input', array('in' => array('text','textarea')));

        foreach ($collection as $attribute) {
            $label = $attribute->getFrontendLabel();
            if ($label) { // skip system and `exclude` attributes
                $options[] = array(
                    'value' => $attribute->getAttributeCode(),
                    'label' => $label
                );
            }
        }

        return $options;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $arr = array(array('' => '-'));
        $optionArray = $this->toOptionArray();
        foreach ($optionArray as $option) {
            $arr[$option['value']] = $option['label'];
        }
    }

}
