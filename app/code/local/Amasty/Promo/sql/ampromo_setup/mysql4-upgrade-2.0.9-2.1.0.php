<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Auto Add Promo Items
*/
$this->startSetup();


$fieldsSql = 'SHOW COLUMNS FROM ' . $this->getTable('salesrule/rule');
$cols = $this->getConnection()->fetchCol($fieldsSql);

if (!in_array('amstore_ids', $cols)){
    $this->run("ALTER TABLE `{$this->getTable('salesrule/rule')}` ADD `amstore_ids` VARCHAR(255) NOT NULL AFTER `promo_sku`");
}

$this->endSetup();