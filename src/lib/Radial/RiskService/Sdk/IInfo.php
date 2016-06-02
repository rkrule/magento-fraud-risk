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

interface Radial_RiskService_Sdk_IInfo extends Radial_RiskService_Sdk_IPayload
{
	/**
	 * @return Radial_RiskService_Sdk_Person_IName
	 */
	public function getPersonName();

	/**
	 * @param  Radial_RiskService_Sdk_Person_IName
	 * @return self
	 */
	public function setPersonName(Radial_RiskService_Sdk_Person_IName $personName);

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
	 * @return Radial_RiskService_Sdk_ITelephone
	 */
	public function getTelephone();

	/**
	 * @param  Radial_RiskService_Sdk_ITelephone
	 * @return self
	 */
	public function setTelephone(Radial_RiskService_Sdk_ITelephone $telephone);

	/**
	 * @return Radial_RiskService_Sdk_IAddress
	 */
	public function getAddress();

	/**
	 * @param  Radial_RiskService_Sdk_IAddress
	 * @return self
	 */
	public function setAddress(Radial_RiskService_Sdk_IAddress $address);
}
