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
    ALTER TABLE `{$this->getTable('amacart/canceled')}`
    CHANGE COLUMN `reason` `reason` ENUM('elapsed','bought','link', 'any_product_out_of_stock', 'all_products_out_of_stock', 'blacklist','admin','updated','quote') DEFAULT NULL;
");

$this->endSetup();