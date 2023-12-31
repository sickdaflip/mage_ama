<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;


$this->startSetup();

$this->run("
      alter table `{$this->getTable('amacart/history')}`
      add column `coupon_expiration_date` datetime DEFAULT NULL after coupon_id;
");

$this->endSetup();