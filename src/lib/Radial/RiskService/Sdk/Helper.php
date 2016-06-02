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

class Radial_RiskService_Sdk_Helper
	implements Radial_RiskService_Sdk_IHelper
{
	/**
	 * @see Radial_RiskService_Sdk_IHelper::convertStringToBoolean()
	 */
	public function convertStringToBoolean($string)
	{
		if (!is_string($string)) {
			return null;
		}
		$string = strtolower($string);
		switch ($string) {
			case 'true':
			case '1':
				return true;
			case 'false':
			case '0':
				return false;
		}
		return null;
	}

	/**
	 * @see Radial_RiskService_Sdk_IHelper::formatAmount()
	 */
	public function formatAmount($amount)
	{
		return sprintf('%01.2F', $amount);
	}

	/**
	 * @see Radial_RiskService_Sdk_IHelper::getPayloadAsXPath()
	 */
	public function getPayloadAsXPath($xmlString, $nameSpace)
	{
		$xpath = new DOMXPath($this->getPayloadAsDoc($xmlString));
		$xpath->registerNamespace('x', $nameSpace);
		return $xpath;
	}

	/**
	 * @see Radial_RiskService_Sdk_IHelper::getPayloadAsDoc()
	 */
	public function getPayloadAsDoc($xmlString)
	{
		$d = new DOMDocument();
		// Suppress the warning error that occurred when the passed in xml string is malformed
		// instead throw a custom exception. Reference http://stackoverflow.com/questions/1759069/
		if(@$d->loadXML($xmlString) === false) {
			$exceptionMessage = "The XML string ($xmlString) is invalid";
			throw Mage::exception('Radial_RiskService_Sdk_Exception_Invalid_Xml', $exceptionMessage);
		}
		$d->encoding = 'utf-8';
		$d->formatOutput = false;
		$d->preserveWhiteSpace = false;
		$d->normalizeDocument();
		return $d;
	}

	/**
	 * @see Mage_Core_Helper_Abstract::escapeHtml()
	 */
	public function escapeHtml($data)
	{
		return Mage::helper('core')->escapeHtml($data);
	}
}
