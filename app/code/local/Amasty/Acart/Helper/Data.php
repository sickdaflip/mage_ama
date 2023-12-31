<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */
class Amasty_Acart_Helper_Data extends Mage_Core_Helper_Abstract
{
    const CONFIG_PATH_DEBUG_MODE_EMAIL_DOMAINS = 'amacart/debug/debug_emails';
    const CONFIG_PATH_DEBUG_MODE_ENABLE = 'amacart/debug/debug_enable';
    const CONFIG_PATH_LOG_PERIOD = 'amacart/log/log_period';

    const ERROR_MESSAGE = 'If there is the following text it means that Amasty_Base is not updated to the latest 
                             version.<p>In order to fix the error, please, download and install the latest version of 
                             the Amasty_Base, which is included in all our extensions.
                        <p>If some assistance is needed, please submit a support ticket with us at: 
                        <a href="https://amasty.com/contacts/" target="_blank">https://amasty.com/contacts/</a>';

    public function getAllGroups()
    {
        $customerGroups = Mage::getResourceModel('customer/group_collection')
            ->load()->toOptionArray();

        $found = false;
        foreach ($customerGroups as $group) {
            if ($group['value'] == 0) {
                $found = true;
            }
        }
        if (!$found) {
            array_unshift(
                $customerGroups, array('value' => 0, 'label' => Mage::helper('salesrule')->__('NOT LOGGED IN'))
            );
        }

        return $customerGroups;
    }

    public function getStatuses()
    {
        return array(
            '1' => Mage::helper('salesrule')->__('Active'),
            '0' => Mage::helper('salesrule')->__('Inactive'),
        );
    }

    /**
     * @return void()
     */
    public function refreshAndProcessHistory()
    {
        Mage::getModel('amacart/schedule')->run();
    }

    public function getCancelRules()
    {
        return array(
            array(
                'value' => Amasty_Acart_Model_Rule::CANCEL_RULE_LINK,
                'label' => $this->__('Link from Email Clicked')
            ),
            array(
                'value' => Amasty_Acart_Model_Rule::CANCEL_RULE_ANY_PRODUCT_OUT_OF_STOCK,
                'label' => $this->__('Any product went out of stock')
            ),
            array(
                'value' => Amasty_Acart_Model_Rule::CANCEL_RULE_ALL_PRODUCTS_OUT_OF_STOCK,
                'label' => $this->__('All products went out of stock')
            ),
            array(
                'value' => Amasty_Acart_Model_Rule::CANCEL_RULE_ANY_PRODUCT_NOT_ACTIVE,
                'label' => $this->__('Any product is not active')
            ),
            array(
                'value' => Amasty_Acart_Model_Rule::CANCEL_RULE_ALL_PRODUCTS_NOT_ACTIVE,
                'label' => $this->__('All products are not active')
            )
        );
    }

    public function getCouponTypes()
    {
        $types = array(
            ''                                              => $this->__('-- None --'),
            Amasty_Acart_Model_Rule::COUPON_CODE_BY_PERCENT => $this->__('Percent of product price discount'),
            Amasty_Acart_Model_Rule::COUPON_CODE_BY_FIXED   => $this->__('Fixed amount discount'),
            Amasty_Acart_Model_Rule::COUPON_CODE_CART_FIXED => $this->__('Fixed amount discount for whole cart'),
        );

        if (Mage::getConfig()->getNode('modules/Amasty_Promo/active') == 'true') {

            $types = array_merge(
                $types, array(
                'ampromo_items'   => Mage::helper('ampromo')->__('Auto add promo items with products'),
                'ampromo_cart'    => Mage::helper('ampromo')->__('Auto add promo items for the whole cart'),
                'ampromo_product' => Mage::helper('ampromo')->__('Auto add the same product')
            ));
        }

        return $types;
    }

    public function getReasonsTypes()
    {
        return array(
            ''                                                            => $this->__('Part of Mails Sent'),
            Amasty_Acart_Model_Canceled::REASON_ELAPSED                   => $this->__('All Mails Sent'),
            Amasty_Acart_Model_Canceled::REASON_BOUGHT                    => $this->__('Order Placed'),
            Amasty_Acart_Model_Canceled::REASON_LINK                      => $this->__('Link Opened'),
            Amasty_Acart_Model_Canceled::REASON_BALCKLIST                 => $this->__('Added to Black List'),
            Amasty_Acart_Model_Canceled::REASON_ADMIN                     => $this->__('Cancelled by Admin'),
            Amasty_Acart_Model_Canceled::REASON_UPDATED                   => $this->__('New Cart Created'),
            Amasty_Acart_Model_Canceled::REASON_QUOTE                     => $this->__('Quote Expired'),
            Amasty_Acart_Model_Canceled::REASON_ANY_PRODUCT_OUT_OF_STOCK  => $this->__('Any product went out of stock'),
            Amasty_Acart_Model_Canceled::REASON_ALL_PRODUCTS_OUT_OF_STOCK => $this->__('All products went out of stock'),
            Amasty_Acart_Model_Canceled::REASON_ANY_PRODUCT_NOT_ACTIVE    => $this->__('Any product is disabled'),
            Amasty_Acart_Model_Canceled::REASON_ALL_PRODUCTS_NOT_ACTIVE   => $this->__('All products are disabled'),
            Amasty_Acart_Model_Canceled::REASON_NOT_ACTIVE                => $this->__('Rule is disabled or Deleted'),
            Amasty_Acart_Model_Canceled::REASON_QUOTE_NOT_VALIDATE        => $this->__('Quote Group is Not Valid'),
        );
    }

    /**
     * @param $timestamp
     * @return false|string
     */
    public function getDate($timestamp)
    {
        return date('Y-m-d H:i:s', $timestamp);
    }

    /**
     * @param $schedule
     * @param $oldScheduledDate
     * @param $siblingSchedule
     * @return mixed
     */
    public function getNewScheduleTime($schedule, $oldScheduledDate, $siblingSchedule = null)
    {
        $oldData = $schedule->getOrigData();
        $newData = $schedule->getData();

        if (!$oldData) {
            $oldDelayed = $siblingSchedule->getDelayedStart();
        } else {
            $oldDelayed = $oldData['delayed_start'];
        }

        return Mage::helper('amacart')->getDate((strtotime($oldScheduledDate) - $oldDelayed)
            + $newData['delayed_start']);
    }

    /**
     * @param $quoteId
     * @return null
     */
    public function loadQuote($quoteId)
    {
        $resource = Mage::getSingleton('core/resource');
        $quoteCollection = Mage::getModel('sales/quote')->getCollection();
        $quoteCollection->getSelect()->joinLeft(
            array('quote2email' => $resource->getTableName('amacart/quote2email')),
            'main_table.entity_id = quote2email.quote_id',
            array('ifnull(main_table.customer_email, quote2email.email) as target_email')
        );

        $quoteCollection->getSelect()->limit(1);
        $quoteCollection->addFieldToFilter(
            'entity_id', array(
            'eq' => $quoteId
        ));

        $items = $quoteCollection->getItems();

        return isset($items[$quoteId]) ? $items[$quoteId] : null;
    }

    /**
     * @return mixed
     */
    public function isDebugMode()
    {
        return Mage::getStoreConfig(self::CONFIG_PATH_DEBUG_MODE_ENABLE);
    }

    /**
     * @return array
     */
    public function getDebugEnabledEmailDomains()
    {
        return $this->isDebugMode() ? explode(',', Mage::getStoreConfig(self::CONFIG_PATH_DEBUG_MODE_EMAIL_DOMAINS))
            : array();
    }

    /**
     * @return false|int
     */
    public function getValidLogPeriodTimestamp()
    {
        $subLogDays = (int)Mage::getStoreConfig(self::CONFIG_PATH_LOG_PERIOD);
        $date = new Zend_Date(Mage::getModel('core/date')->gmtTimestamp());
        $date->subDay($subLogDays);

        return $date->toValue();
    }

    /**
     * @param string $string
     *
     * @return array|null
     */
    public function unserialize($string)
    {
        if (!@class_exists('Amasty_Base_Helper_String')) {
            Mage::logException(new Exception(self::ERROR_MESSAGE));

            if (Mage::app()->getStore()->isAdmin()) {
                Mage::helper('ambase/utils')->_exit(self::ERROR_MESSAGE);
            } else {
                Mage::throwException($this->__('Sorry, something went wrong. Please contact us or try again later.'));
            }
        }

        return \Amasty_Base_Helper_String::unserialize($string);
    }
}
