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

class Radial_Eb2cFraud_Model_Payment_Adapter_Default
	extends Radial_Eb2cFraud_Model_Payment_Adapter_Type
{
	protected function _initialize()
	{
		$payment = $this->_order->getPayment();
		$owner = $payment->getCcOwner();
		$additionalInformation = $payment->getAdditionalInformation();

		if(!$owner)
		{	
			$owner = $this->_order->getBillingAddress()->getName();
		}

		$this->setExtractCardHolderName($owner)
			->setExtractPaymentAccountUniqueId($this->_helper->getAccountUniqueId($payment))
			->setExtractIsToken(static::IS_TOKEN)
			->setExtractPaymentAccountBin($this->_helper->getAccountBin($payment))
			->setExtractExpireDate($this->_helper->getPaymentExpireDate($payment))
			->setExtractCardType($this->_helper->getMapEb2cFraudPaymentMethod($payment));

		if( array_key_exists('avs_response_code', $additionalInformation) && array_key_exists('cvv2_response_code', $additionalInformation))
		{
			$this->setExtractTransactionResponses(array(
					array('type' => 'avsZip', 'response' => $additionalInformation['avs_response_code']),
					array('type' => 'avsAddr', 'response' => $additionalInformation['avs_response_code']),
					array('type' => 'cvv2',	   'response' => $additionalInformation['cvv2_response_code'])));
		}

		return $this;
	}
}
