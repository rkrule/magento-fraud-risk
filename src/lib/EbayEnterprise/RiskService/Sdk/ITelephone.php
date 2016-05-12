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

interface EbayEnterprise_RiskService_Sdk_ITelephone extends EbayEnterprise_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'Telephone';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

	/**
	 * @return string
	 */
	public function getCountryCode();

	/**
	 * @param  string
	 * @return self
	 */
	public function setCountryCode($countryCode);

	/**
	 * @return string
	 */
	public function getAreaCode();

	/**
	 * @param  string
	 * @return self
	 */
	public function setAreaCode($areaCode);

	/**
	 * @return string
	 */
	public function getNumber();

	/**
	 * @param  string
	 * @return self
	 */
	public function setNumber($number);

	/**
	 * @return string
	 */
	public function getExtension();

	/**
	 * @param  string
	 * @return self
	 */
	public function setExtension($extension);
}
