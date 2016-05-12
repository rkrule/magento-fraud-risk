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

interface EbayEnterprise_RiskService_Sdk_IInfo extends EbayEnterprise_RiskService_Sdk_IPayload
{
	/**
	 * @return EbayEnterprise_RiskService_Sdk_Person_IName
	 */
	public function getPersonName();

	/**
	 * @param  EbayEnterprise_RiskService_Sdk_Person_IName
	 * @return self
	 */
	public function setPersonName(EbayEnterprise_RiskService_Sdk_Person_IName $personName);

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
	 * @return EbayEnterprise_RiskService_Sdk_ITelephone
	 */
	public function getTelephone();

	/**
	 * @param  EbayEnterprise_RiskService_Sdk_ITelephone
	 * @return self
	 */
	public function setTelephone(EbayEnterprise_RiskService_Sdk_ITelephone $telephone);

	/**
	 * @return EbayEnterprise_RiskService_Sdk_IAddress
	 */
	public function getAddress();

	/**
	 * @param  EbayEnterprise_RiskService_Sdk_IAddress
	 * @return self
	 */
	public function setAddress(EbayEnterprise_RiskService_Sdk_IAddress $address);
}
