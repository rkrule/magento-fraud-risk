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

interface Radial_RiskService_Sdk_IError extends Radial_RiskService_Sdk_Payload_ITop
{
	const ROOT_NODE = 'RiskServiceErrorResponse';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';
	const XSD = 'RiskServiceErrorResponse.xsd';

	/**
	 * @return string
	 */
	public function getErrorCode();

	/**
	 * @param  string
	 * @return self
	 */
	public function setErrorCode($errorCode);

	/**
	 * @return string
	 */
	public function getErrorDescription();

	/**
	 * @param  string
	 * @return self
	 */
	public function setErrorDescription($errorDescription);

	/**
	 * @return string
	 */
	public function getExceptionLog();

	/**
	 * @param  string
	 * @return self
	 */
	public function setExceptionLog($exceptionLog);
}
