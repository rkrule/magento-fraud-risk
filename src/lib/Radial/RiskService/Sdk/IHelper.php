<?php
/**
 * Copyright (c) 2015 Radial, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Radial
 * Magento Extensions End User License Agreement
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * http://www.radial.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf
 *
 * @copyright   Copyright (c) 2015 Radial, Inc. (http://www.radial.com/)
 * @license     http://www.radial.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf  Radial Magento Extensions End User License Agreement
 *
 */

interface Radial_RiskService_Sdk_IHelper
{
	/**
	 * Convert "true", "false", "1" or "0" to boolean
	 * Everything else returns null
	 *
	 * @param  string
	 * @return bool | null
	 */
	public function convertStringToBoolean($string);

	/**
	 * Consistent formatting of amounts.
	 *
	 * @param  float
	 * @return string
	 */
	public function formatAmount($amount);

	/**
	 * Load the payload XML into a DOMXPath for querying.
	 *
	 * @param  string
	 * @param  string
	 * @return DOMXPath
	 */
	public function getPayloadAsXPath($xmlString, $nameSpace);

	/**
	 * Load the payload XML into a DOMDocument
	 *
	 * @param  string
	 * @return DOMDocument
	 * @throws Radial_RiskService_Sdk_Exception_Invalid_Xml_Exception
	 */
	public function getPayloadAsDoc($xmlString);

}
