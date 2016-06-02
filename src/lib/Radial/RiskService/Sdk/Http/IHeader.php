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

interface Radial_RiskService_Sdk_Http_IHeader extends Radial_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'HttpHeader';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

	/**
	 * Each HttpHeader element represents one HTTP header entry collected from the HTTP session for the customer's order.
	 * Implementation Notes: Header names should conform to HTTP 1.1 spec.
	 *
	 * Sample data:
	 * <HttpHeader name="user-agent"> Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/7.0;
	 * SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)
	 * </HttpHeader>
	 * @return string
	 */
	public function getHeader();

	/**
	 * @param  string
	 * @return self
	 */
	public function setHeader($header);

	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @param  string
	 * @return self
	 */
	public function setName($name);
}
