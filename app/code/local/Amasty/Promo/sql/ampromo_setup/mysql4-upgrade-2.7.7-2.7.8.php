<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Auto Add Promo Items
*/
$this->startSetup();

$this->run("ALTER TABLE `{$this->getTable('salesrule/rule')}` CHANGE `discount_step` `discount_step` DECIMAL(12,4) UNSIGNED NOT NULL COMMENT 'Discount Step'");

$this->endSetup();
