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

interface EbayEnterprise_RiskService_Model_Payment_Adapter_IType
{
	const IS_TOKEN = 'true';
	const IS_NOT_TOKEN = 'false';

	/**
	 * @return string | null
	 */
	public function getExtractCardHolderName();

	/**
	 * @param  string
	 * @return self
	 */
	public function setExtractCardHolderName($cardHolderName);

	/**
	 * @return string | null
	 */
	public function getExtractPaymentAccountUniqueId();

	/**
	 * @param  string
	 * @return self
	 */
	public function setExtractPaymentAccountUniqueId($paymentAccountUniqueId);

	/**
	 * @return string | null
	 */
	public function getExtractPaymentAccountBin();

	/**
	 * @param  string
	 * @return self
	 */
	public function setExtractPaymentAccountBin($paymentAccountBin);

	/**
	 * @return string | null
	 */
	public function getExtractExpireDate();

	/**
	 * @param  string
	 * @return self
	 */
	public function setExtractExpireDate($expireDate);

	/**
	 * @return string | null
	 */
	public function getExtractCardType();

	/**
	 * @param  string
	 * @return self
	 */
	public function setExtractCardType($cardType);

	/**
	 * @return array
	 */
	public function getExtractTransactionResponses();

	/**
	 * @param  array
	 * @return self
	 */
	public function setExtractTransactionResponses(array $transactionResponses);

	/**
	 * @return string | null
	 */
	public function getExtractIsToken();

	/**
	 * @param  string
	 * @return self
	 */
	public function setExtractIsToken($isToken);
}
