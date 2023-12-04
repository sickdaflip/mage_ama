<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */
class Amasty_Acart_Block_Adminhtml_Rule_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id'; 
        $this->_blockGroup = 'amacart';
        $this->_controller = 'adminhtml_rule';
        
        $this->_addButton('save_and_continue', array(
                'label'     => Mage::helper('salesrule')->__('Save and Continue Edit'),
                'onclick'   => 'saveAndContinueEdit(\'' . $this->getSaveAndContinueUrl() . '\')',
                'class' => 'save'
            ), 10);

        $this->_formScripts[] = " function saveAndContinueEdit(url) { editForm.submit(url) } ";
    }

    public function getHeaderText()
    {
        $header = Mage::helper('amacart')->__('New Rule');
        $model = $this->getModel();//Mage::registry('amacart_rule');
        
        if ($model->getId()) {
            $header = Mage::helper('amacart')->__('Edit Rule `%s`', $model->getName());
        }

        return $header;
    }

    public function getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', array(
            '_current' => true,
            'continue' => 'edit'
        ));
    }
}
