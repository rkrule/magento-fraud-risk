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

interface Radial_RiskService_Sdk_Person_IName extends Radial_RiskService_Sdk_IPayload
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
