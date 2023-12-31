<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Auto Add Promo Items
*/
$this->startSetup();

$this->run("ALTER TABLE `{$this->getTable('salesrule/rule')}`
ADD COLUMN `ampromo_top_banner_enable` SMALLINT(6) NOT NULL DEFAULT '0',
ADD COLUMN `ampromo_after_name_banner_enable` SMALLINT(6) NOT NULL DEFAULT '0',
ADD COLUMN `ampromo_label_enable` SMALLINT(6) NOT NULL DEFAULT '0';
");


$this->endSetup();