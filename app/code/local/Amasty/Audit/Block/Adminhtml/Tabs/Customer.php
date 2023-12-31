<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Admin Actions Log
*/

class Amasty_Audit_Block_Adminhtml_Tabs_Customer extends Amasty_Audit_Block_Adminhtml_Tabs_DefaultItemColumns
{
    protected function _prepareCollection()
    {
        $elementId = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('amaudit/log')->getCollection();
        $classes = array(
            'Mage_Customer_Model_Customer',
            'Mage_Customer_Model_Address',
            'Amasty_Customerattr_Model_Rewrite_Customer',
            'Dudit_Customermodule_Model_Customer'
        );

        foreach ($classes as $key => $class) {
            $classes[$key] = 'model like "' . $class . '%"';
        }

        $whereModel = '(' . implode(') OR (', $classes) . ')';

        $collection->getSelect()
            ->joinLeft(
                array('r' => Mage::getSingleton('core/resource')->getTableName('amaudit/log_details')),
                'main_table.entity_id = r.log_id',
                array('is_logged' => 'MAX(r.log_id)')
            )
            ->where("element_id = ?", $elementId)
            ->where($whereModel)
            ->group('r.log_id')
        ;

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }
}
