<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$this->startSetup();

$this->run("
    ALTER TABLE `{$this->getTable('amacart/rule')}`
    change column `cust_groups` `cust_groups` text NOT NULL DEFAULT '';
");

$this->endSetup();