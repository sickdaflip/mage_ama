<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Admin Actions Log
*/
$installer = $this;
$this->startSetup();

$this->run("
ALTER TABLE `{$this->getTable('amaudit/data')}` ADD `count_entry` INT(5) DEFAULT '1';
TRUNCATE TABLE `{$this->getTable('amaudit/active')}`;
");

$this->endSetup();
