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

interface Radial_RiskService_Sdk_Transaction_IResponse extends Radial_RiskService_Sdk_IPayload
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
