<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */

$this->startSetup();

$this->run("
    alter table `{$this->getTable('amacart/canceled')}`
    change column reason `reason` ENUM('elapsed','bought','link','blacklist','admin','updated');
");

$this->endSetup(); 