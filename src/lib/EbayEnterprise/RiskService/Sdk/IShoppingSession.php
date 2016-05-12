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

interface EbayEnterprise_RiskService_Sdk_IShoppingSession extends EbayEnterprise_RiskService_Sdk_IPayload
{
    const ROOT_NODE = 'ShoppingSession';
    const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

    /**
     * xsd restrictions - integer format in hours / minutes
     * @return string
     */
    public function getTimeOnSite();

    /**
     * @param  Integer
     * @return self
     */
    public function setTimeOnSite($timeOnSite);

    /**
     * @return boolean
     */
    public function getReturnCustomer();

    /**
     * @param  boolean
     * @return self
     */
    public function setReturnCustomer($returnCustomer);

    /**
     * boolean
     * @return string
     */
    public function getItemsRemoved();

    /**
     * @param  boolean
     * @return self
     */
    public function setItemsRemoved($itemsRemoved);
}
