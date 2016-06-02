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

class Radial_Eb2cFraud_Model_Payment_Adapter_Purchase_Order
	extends Radial_Eb2cFraud_Model_Payment_Adapter_Type
{
	protected function _initialize()
	{
		$payment = $this->_order->getPayment();
		$this->setExtractCardHolderName(null)
			->setExtractPaymentAccountUniqueId($this->_getBase64HashPurchaseOrderNumber($payment))
			->setExtractIsToken(static::IS_TOKEN)
			->setExtractPaymentAccountBin($this->_getPurchaseOrderNumberAccountBin($payment))
			->setExtractExpireDate(null)
			->setExtractCardType($this->_helper->getPaymentMethodValueFromMap($payment->getMethod()))
			->setExtractTransactionResponses(array());
		return $this;
	}

	/**
	 * Get the raw purchase order number.
	 *
	 * @param  Mage_Sales_Model_Order_Payment
	 * @return string | null
	 */
	protected function _getRawPurchaseOrderNumber(Mage_Sales_Model_Order_Payment $payment)
	{
		return $payment->getPoNumber() ?: null;
	}

	/**
	 * @param  Mage_Sales_Model_Order_Payment
	 * @return string | null
	 */
	protected function _getBase64HashPurchaseOrderNumber(Mage_Sales_Model_Order_Payment $payment)
	{
		$rawPurchaseOrderNumber = $this->_getRawPurchaseOrderNumber($payment);
		return $rawPurchaseOrderNumber ? $this->_helper->hashAndEncodeCc($rawPurchaseOrderNumber) : null;
	}

	/**
	 * @param  Mage_Sales_Model_Order_Payment
	 * @return string | null
	 */
	protected function _getPurchaseOrderNumberAccountBin(Mage_Sales_Model_Order_Payment $payment)
	{
		$rawPurchaseOrderNumber = $this->_getRawPurchaseOrderNumber($payment);
		return $this->_helper->getFirstSixChars($rawPurchaseOrderNumber);
	}
}
