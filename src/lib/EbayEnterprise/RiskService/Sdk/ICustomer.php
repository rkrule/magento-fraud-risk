<?php
/**
 * Copyright (c) 2015 eBay Enterprise, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the eBay Enterprise
 * Magento Extensions End User License Agreement
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * http://www.ebayenterprise.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf
 *
 * @copyright   Copyright (c) 2015 eBay Enterprise, Inc. (http://www.ebayenterprise.com/)
 * @license     http://www.ebayenterprise.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf  eBay Enterprise Magento Extensions End User License Agreement
 *
 */

interface EbayEnterprise_RiskService_Sdk_ICustomer extends EbayEnterprise_RiskService_Sdk_IPayload
{
    const ROOT_NODE = 'Customer';
    const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';
    const PERSON_NAME_MODEL ='EbayEnterprise_RiskService_Sdk_Person_Name';
    const TELEPHONE_MODEL = 'EbayEnterprise_RiskService_Sdk_Telephone';
    const ADDRESS_MODEL = 'EbayEnterprise_RiskService_Sdk_Address';

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param  string
     * @return self
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getMemberLoggedIn();

    /**
     * @param  boolean
     * @return self
     */
    public function setMemberLoggedIn($memberLoggedIn);

    /**
     * @return string
     */
    public function getCurrencyCode();

    /**
     * @param  string
     * @return self
     */
    public function setCurrencyCode($currencyCode);
}
