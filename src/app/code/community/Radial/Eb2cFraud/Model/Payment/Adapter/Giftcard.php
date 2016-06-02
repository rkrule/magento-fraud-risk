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

class Radial_Eb2cFraud_Model_Payment_Adapter_Giftcard
	extends Radial_Eb2cFraud_Model_Payment_Adapter_Type
{
	const PAYMENT_METHOD_TYPE = 'giftcard';

	/** @var Enterprise_GiftCardAccount_Model_Giftcardaccount */
	protected $_giftcardaccount;

	/**
	 * @param array $initParams Must have this key:
	 *                          - 'giftcardaccount' => Enterprise_GiftCardAccount_Model_Giftcardaccount
	 */
	public function __construct(array $initParams=array())
	{
		$this->_giftcardaccount = $this->_checkGiftcardModelType(
			$this->_nullCoalesce($initParams, 'giftcardaccount', Mage::getModel('enterprise_giftcardaccount/giftcardaccount'))
		);
		parent::__construct($initParams);
	}

	/**
	 * Type hinting for self::__construct $initParams
	 *
	 * @param  Enterprise_GiftCardAccount_Model_Giftcardaccount
	 * @return Enterprise_GiftCardAccount_Model_Giftcardaccount
	 */
	protected function _checkGiftcardModelType(Enterprise_GiftCardAccount_Model_Giftcardaccount $giftcardaccount)
	{
		return $giftcardaccount;
	}

	protected function _initialize()
	{
		$this->setExtractCardHolderName(null)
			->setExtractPaymentAccountUniqueId($this->_getBase64HashGiftcardCode())
			->setExtractIsToken(static::IS_TOKEN)
			->setExtractPaymentAccountBin($this->_getGiftcardAccountBin())
			->setExtractExpireDate($this->_getGiftCardExpireDate())
			->setExtractCardType($this->_helper->getPaymentMethodValueFromMap(static::PAYMENT_METHOD_TYPE))
			->setExtractTransactionResponses(array());
		return $this;
	}

	/**
	 * Get the raw gift card code from a passed in gift card data.
	 *
	 * @return string | null
	 */
	protected function _getRawGiftCardCode()
	{
		$cards = $this->_helper->getGiftCard($this->_order);
		$card = count($cards) ? $cards[0] : array();
		return $this->_nullCoalesce($card, 'c', null);
	}

	/**
	 * @return string | null
	 */
	protected function _getBase64HashGiftcardCode()
	{
		$rawGiftCardCode = $this->_getRawGiftCardCode();
		return $rawGiftCardCode ? $this->_helper->hashAndEncodeCc($rawGiftCardCode) : null;
	}

	/**
	 * @return string | null
	 */
	protected function _getGiftcardAccountBin()
	{
		$rawGiftCardCode = $this->_getRawGiftCardCode();
		return $this->_helper->getFirstSixChars($rawGiftCardCode);
	}

	/**
	 * @return string | null
	 */
	protected function _getGiftCardExpireDate()
	{
		$this->_giftcardaccount->loadByCode($this->_getRawGiftCardCode());
		return $this->_giftcardaccount->getId()
			? $this->_extractGiftCardExpireDate() : null;
	}

	/**
	 * @return string
	 */
	protected function _extractGiftCardExpireDate()
	{
		$expireDate = $this->_getNewDateTimeOfGiftCardExpireDate();
		return $expireDate->format('Y-m');
	}

	/**
	 * @return DateTime
	 */
	protected function _getNewDateTimeOfGiftCardExpireDate()
	{
		return new DateTime($this->_giftcardaccount->getDateExpires());
	}
}
