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

class EbayEnterprise_RiskService_Model_Payment_Adapter_Authorizenet
	extends EbayEnterprise_RiskService_Model_Payment_Adapter_Type
{
	protected function _initialize()
	{
		$payment = $this->_order->getPayment();
		$cardsData = $this->_getCardsData($this->_getPaymentMethod($payment));
		$this->setExtractCardHolderName(null)
			->setExtractPaymentAccountUniqueId(null)
			->setExtractIsToken(static::IS_NOT_TOKEN)
			->setExtractPaymentAccountBin(null)
			->setExtractExpireDate($this->_getExtractExpireDate($cardsData))
			->setExtractCardType($this->_getExtractCardType($cardsData))
			->setExtractTransactionResponses(array());
		return $this;
	}

	/**
	 * @param  Mage_Payment_Model_Info
	 * @return Mage_Payment_Model_Method_Cc
	 */
	protected function _getPaymentMethod(Mage_Payment_Model_Info $payment)
	{
		return $payment->getMethodInstance();
	}

	/**
	 * @param  Mage_Payment_Model_Method_Cc
	 * @return array
	 */
	protected function _getCardsData(Mage_Payment_Model_Method_Cc $method)
	{
		return (array) $this->_getCardsStorage($method)->getCards();
	}

	/**
	 * @param  Mage_Payment_Model_Method_Cc
	 * @return Mage_Paygate_Model_Authorizenet_Cards
	 */
	protected function _getCardsStorage(Mage_Payment_Model_Method_Cc $method)
	{
		return $method->getCardsStorage();
	}

	/**
	 * @param  array
	 * @return Varien_Object | false
	 */
	protected function _getCard(array $cards)
	{
		return reset($cards);
	}

	/**
	 * @param  array
	 * @param  string
	 * @return string | null
	 */
	protected function _getData(array $cards, $method)
	{
		$card = $this->_getCard($cards);
		return $card ? $card->$method() : null;
	}

	/**
	 * @param  array
	 * @return string | null
	 */
	protected function _getExtractExpireDate(array $cards)
	{
		$month = $this->_getData($cards, 'getCcExpMonth');
		$year = $this->_getData($cards, 'getCcExpYear');
		return ($month && $year) ? $this->_helper->getYearMonth($year, $month) : null;
	}

	/**
	 * @param  array
	 * @return string | null
	 */
	protected function _getExtractCardType(array $cards)
	{
		return $this->_helper->getPaymentMethodValueFromMap(
			$this->_getData($cards, 'getCcType')
		);
	}
}
