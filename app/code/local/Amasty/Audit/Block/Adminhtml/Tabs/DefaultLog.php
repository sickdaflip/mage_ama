<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Admin Actions Log
*/

abstract class Amasty_Audit_Block_Adminhtml_Tabs_DefaultLog extends Amasty_Audit_Block_Adminhtml_DefaultLog
{
    public function __construct()
    {
        parent::__construct();
        $this->setUseAjax(true);
    }
}
