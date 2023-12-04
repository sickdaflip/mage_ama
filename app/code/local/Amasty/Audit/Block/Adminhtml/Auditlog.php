<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Admin Actions Log
*/
class Amasty_Audit_Block_Adminhtml_Auditlog extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'adminhtml_auditlog';
        $this->_blockGroup = 'amaudit';
        $this->_headerText = Mage::helper('amaudit')->__('Login Attempts');
        $this->_removeButton('add'); 
    }

    protected function _prepareLayout()
    {
        $script = "
            if (confirm('".Mage::helper('catalog')->__('Are you sure?')."'))
                window.location.href='".$this->getUrl('adminhtml/amaudit_login/clear')."';
        ";

        if (Mage::helper('amaudit')->allowClear()) {
            $this->addButton('clear', array(
                'label' => Mage::helper('amaudit')->__('Clear Log'),
                'onclick' => $script,
                'class' => 'delete',
            ));
        }

        return parent::_prepareLayout();
    }
}