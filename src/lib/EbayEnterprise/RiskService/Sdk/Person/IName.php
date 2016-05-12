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

interface EbayEnterprise_RiskService_Sdk_Person_IName extends EbayEnterprise_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'PersonName';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

	/**
	 * @return string
	 */
	public function getLastName();

	/**
	 * @param  string
	 * @return self
	 */
	public function setLastName($lastName);

	/**
	 * xsd restrictions: <= 10 characters
	 * @return string
	 */
	public function getMiddleName();

	/**
	 * @param  string
	 * @return self
	 */
	public function setMiddleName($middleName);

	/**
	 * @return string
	 */
	public function getFirstName();

	/**
	 * @param  string
	 * @return self
	 */
	public function setFirstName($firstName);
}
