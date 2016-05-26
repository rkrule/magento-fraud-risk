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

interface EbayEnterprise_RiskService_Sdk_Server_IInfo extends EbayEnterprise_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'ServerInfo';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

	/**
	 * xsd restrictions - datetime format
	 * @return string
	 */
	public function getTime();

	/**
	 * @param  DateTime
	 * @return self
	 */
	public function setTime(DateTime $time);

    /**
     * xsd restrictions - in hours
     * @return string
     */
    public function getTZOffset();

    /**
     * @param  string
     * @return self
     */
    public function setTZOffset($tzOffset);

    /**
     * xsd restrictions - in hours
     * @return string
     */
    public function getTZOffsetRaw();

    /**
     * @param  string
     * @return self
     */
    public function setTZOffsetRaw($tzOffsetRaw);

    /**
     * xsd restrictions - boolean DST Active
     * @return string
     */
    public function getDSTActive();

    /**
     * @param  boolean
     * @return self
     */
    public function setDSTActive($dstActive);
}
