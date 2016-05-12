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

interface EbayEnterprise_RiskService_Sdk_Transaction_IResponse extends EbayEnterprise_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'TransactionResponse';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

	/**
	 * value comes from list: {'M'|'N'|'confirmed'|'verified'|'X'}
	 *
	 * @return string
	 */
	public function getResponse();
	/**
	 * @param  string
	 * @return self
	 */
	public function setResponse($response);

	/**
	 * Each transaction response specifies the type of transaction response and the value returned.
	 * Sample Data:
	 * <TransactionResponse ResponseType="avsAddr"> Y</TransactionResponse>
	 * <TransactionResponse ResponseType="avsZip"> Y</TransactionResponse>
	 * <TransactionResponse ResponseType="cvv2"> M</TransactionResponse>
	 *
	 * @return string
	 */
	public function getResponseType();

	/**
	 * @param  string
	 * @return self
	 */
	public function setResponseType($responseType);
}
