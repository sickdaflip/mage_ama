<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Admin Actions Log
*/
$this->startSetup();

$this->run("

ALTER TABLE `{$this->getTable('amaudit/data')}` ADD `user_agent` TEXT;
");

$this->endSetup();
