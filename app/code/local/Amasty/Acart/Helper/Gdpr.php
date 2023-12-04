<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Abandoned Cart Email
 */

class Amasty_Acart_Helper_Gdpr extends Mage_Core_Helper_Abstract
{
    /**
     * @param string $remoteIp
     *
     * @return bool
     */
    public function isEEACountryByIP($remoteIp = '')
    {
        $geolocation = Mage::getModel('amgeoip/geolocation');
        $geolocation->locate($remoteIp);
        $countryCode = $geolocation->getData('country');

        return $this->isEEACountry($countryCode) && $this->haveToCheckGDPR();
    }

    /**
     * @param $countryCode
     *
     * @return bool
     */
    public function isEEACountry($countryCode)
    {
        $eeaCountries = explode(',', Mage::getStoreConfig('amacart/eea_countries'));
        return in_array($countryCode, $eeaCountries);
    }

    /**
     * @return bool
     */
    public function haveToCheckGDPR()
    {
        return (bool)Mage::getStoreConfig('amacart/general/gdpr');
    }
}
