<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Auto Add Promo Items
*/

class Amasty_Promo_Model_SalesRule_Rule_Condition_Product_Combine
    extends Mage_SalesRule_Model_Rule_Condition_Product_Combine
{
    /**
     * @param Varien_Object $object
     * @return bool
     */
    public function validate(Varien_Object $object)
    {
        $origProduct = null;
        if ($object->getHasChildren() && $object->getProductType() == 'configurable') {
            //remember original product
            $origProduct = $object->getProduct();
            
            $origSku = $object->getSku();
            foreach ($object->getChildren() as $child) {
                // only one itereation.
                $categoryIds = array_merge($child->getProduct()->getCategoryIds(), $origProduct->getCategoryIds());
                $categoryIds = array_unique($categoryIds);
                $object->setProduct($child->getProduct());
                //load all attributes for validation
                $object->getProduct()->load($child->getProduct()->getId());
                $object->setSku($child->getSku());
                $object->getProduct()->setCategoryIds($categoryIds);
            }
        }
        //$result = @Mage_Rule_Model_Condition_Combine::validate($object);

        $validator = new Mage_Rule_Model_Condition_Combine();
        $validator->setData($this->getData());
        $result = $validator->validate($object);
        $this->setData($validator->getData());

        if ($origProduct) {
            // restore original product
            $object->setProduct($origProduct);
            $object->setSku($origSku);
        }

        if ($result) {
            $result = $this->validateStores($object);
        }

        return $result;
    }

    /**
     * @param $object
     * @return bool
     */
    protected function validateStores($object)
    {
        $amStores = explode(',', $this->getRule()->getAmstoreIds());
        $currentStoreId = Mage::app()->getStore()->getId();

        if ($currentStoreId == '0') {
            $currentStoreId = $object->getStoreId();
        }

        if (!in_array($currentStoreId, $amStores) && !in_array(0, $amStores)) {
            return false;
        }

        return true;
    }

    protected function _initializeProductAttributesInfo()
    {
        parent::_initializeProductAttributesInfo();

        foreach (Mage::helper('ampromo')->getIsNotAllowedAssignedAttributes() as $code) {
            $conditionKey = "salesrule/rule_condition_product_attribute_assigned|$code";
            unset($this->_productAttributesInfo['product_attribute_isset'][$conditionKey]);
        }
    }
}
