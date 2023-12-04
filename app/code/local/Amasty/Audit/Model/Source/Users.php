<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Admin Actions Log
*/
class Amasty_Audit_Model_Source_Users extends Varien_Object
{
    public function toOptionArray()
    {
        $hlp = Mage::helper('amaudit');
        $collection = Mage::getModel('admin/user')->getCollection();
        $options = array();

        foreach($collection as $item) {
            $options[] = array(
                    'value' => $item->getId(),
                    'label' => $item->getName() . ' (' . $hlp->getUsername($item->getId()) . ')',
            );    
        }

        return $options;
    }
}