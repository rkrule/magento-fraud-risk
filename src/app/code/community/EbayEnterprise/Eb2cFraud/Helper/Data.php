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
 * http://www.radial.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf
 *
 * @copyright   Copyright (c) 2015 eBay Enterprise, Inc. (http://www.radial.com/)
 * @license     http://www.radial.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf  eBay Enterprise Magento Extensions End User License Agreement
 *
 */

class EbayEnterprise_Eb2cFraud_Helper_Data extends Mage_Core_Helper_Abstract
{
	const DEFAULT_LANGUAGE_CODE = 'en';
	const FREE_PAYMENT_METHOD = 'free';
	const RISK_SERVICE_GIFT_CARD_PAYMENT_METHOD = 'GC';
	const RISK_SERVICE_DEFAULT_PAYMENT_METHOD = 'OTHER';

	/** @var EbayEnterprise_Eb2cFraud_Helper_Config */
	protected $_config;
	/** @var array */
	protected $_paymentMethodMap;

	public function __construct()
	{
		$this->_config = Mage::helper('eb2cfraud/config');
	}

	/**
	 * Get all header data.
	 *
	 * @return array
	 */
	public function getHeaderData()
	{
		$headers = array();
		foreach ($_SERVER as $name => $value) {
			if (substr($name, 0, 5) == 'HTTP_') {
				$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
			}
		}
		return $headers;
	}

	/**
	 * Get a collection of risk service object where UCP request has not been sent.
	 *
	 * @return EbayEnterprise_Eb2cFraud_Model_Resource_Risk_Service_Collection
	 */
	public function getEb2cFraudCollection()
	{
		return Mage::getResourceModel('eb2cfraud/risk_service_collection')
			->addFieldToFilter('is_request_sent', 0);
	}

	/**
	 * Get a collection of risk service object where the risk service request had already been sent,
	 * there was no successful feedback request sent, and the fail attempt feedback request counter is
	 * less than the configured threshold.
	 *
	 * @return EbayEnterprise_Eb2cFraud_Model_Resource_Risk_Service_Collection
	 */
	public function getFeedbackOrderCollection()
	{
		return Mage::getResourceModel('eb2cfraud/risk_service_collection')
			->addFieldToFilter('is_request_sent', 1)
			->addFieldToFilter('is_feedback_sent', 0)
			->addFieldToFilter('feedback_sent_attempt_count', array(
				'lt' => $this->_config->getFeedbackResendThreshold()
			));
	}

	/**
	 * Getting a collection of sales/order object filtered by increment ids.
	 *
	 * @param  array
	 * @return Mage_Sales_Model_Resource_Order_Collection
	 */
	public function getOrderCollectionByIncrementIds(array $incrementIds=array())
	{
		return Mage::getResourceModel('sales/order_collection')
			->addFieldToFilter('increment_id', array('in' => $incrementIds));
	}

	/**
	 * @param  string
	 * @return DateTime
	 */
	public function getNewDateTime($dateTime)
	{
		return new DateTime($dateTime);
	}

	/**
	 * Get Magento locale language code.
	 *
	 * @return string
	 */
	public function getLanguageCode()
	{
		$locale = trim(Mage::app()->getLocale()->getLocaleCode());
		return $locale ? substr($locale, 0, 2) : static::DEFAULT_LANGUAGE_CODE;
	}

	/**
	 * Get a loaded risk service object by order increment id from the passed in sales order object.
	 *
	 * @param  Mage_Sales_Model_Order
	 * @return EbayEnterprise_Eb2cFraud_Model_Risk_Service
	 */
	public function getEb2cFraud(Mage_Sales_Model_Order $order)
	{
		return Mage::getModel('eb2cfraud/risk_service')
			->load($order->getIncrementId(), 'order_increment_id');
	}

	/**
	 * Check if risk service request has already been sent for the passed in order.
	 *
	 * @param  Mage_Sales_Model_Order
	 * @return bool
	 */
	public function isEb2cFraudRequestSent(Mage_Sales_Model_Order $order)
	{
		return ((int) $this->getEb2cFraud($order)->getIsRequestSent() === 1);
	}

	/**
	 * Get the source of an order, determined by the area in which the order
	 * was placed: admin or frontend.
	 *
	 * @param  Mage_Sales_Model_Order
	 * @return string
	 */
	public function getOrderSourceByArea(Mage_Sales_Model_Order $order)
	{
		return $this->_isAdminOrder($order)
			? EbayEnterprise_Eb2cFraud_Model_System_Config_Source_Ordersource::DASHBOARD
			: EbayEnterprise_Eb2cFraud_Model_System_Config_Source_Ordersource::WEBSTORE;
	}

	/**
	 * Determine if the passed in order object was created from the admin interface.
	 *
	 * @param  Mage_Sales_Model_Order
	 * @return bool
	 */
	protected function _isAdminOrder(Mage_Sales_Model_Order $order)
	{
		// Magento store remote ip address for front-end customer order and not for Admin orders.
		// For more information reference this link http://magento.stackexchange.com/questions/16757/
		return !$order->getRemoteIp();
	}

	/**
	 * @param  Mage_Sales_Model_Order
	 * @param  Mage_Sales_Model_Order_Payment
	 * @return bool
	 */
	public function isGiftCardPayment(
		Mage_Sales_Model_Order $order,
		Mage_Sales_Model_Order_Payment $payment
	)
	{
		return ($this->_hasGiftCard($order) && ($payment->getMethod() === static::FREE_PAYMENT_METHOD));
	}

	/**
	 * Determine if the passed in order has gift card data.
	 *
	 * @param  Mage_Sales_Model_Order
	 * @return bool
	 */
	protected function _hasGiftCard(Mage_Sales_Model_Order $order)
	{
		$giftCards = $this->getGiftCard($order);
		return !empty($giftCards);
	}

	/**
	 * Get the gift card data in the order.
	 *
	 * @param  Mage_Sales_Model_Order
	 * @return array
	 */
	public function getGiftCard(Mage_Sales_Model_Order $order)
	{
		return (array) unserialize($order->getGiftCards());
	}

	/**
	 * Used configuration map to retrieve enumerated value for the risk service request.
	 *
	 * @param  Mage_Sales_Model_Order_Payment
	 * @return string
	 */
	public function getMapEb2cFraudPaymentMethod(Mage_Sales_Model_Order_Payment $payment)
	{
		$method = $this->_config->getTenderNameForCcType($payment->getCcType())
			?: $this->_config->getTenderNameForCcType($payment->getMethod());
		return $method ?: static::RISK_SERVICE_DEFAULT_PAYMENT_METHOD;
	}

	/**
	 * @param  string
	 * @return string | null
	 */
	public function getPaymentMethodValueFromMap($key)
	{
		return isset($this->_paymentMethodMap[$key]) ? $this->_paymentMethodMap[$key] : null;
	}

	/**
	 * @param  Mage_Sales_Model_Order_Payment
	 * @return string | null
	 */
	protected function _decryptCc(Mage_Sales_Model_Order_Payment $payment)
	{
		$encryptedCc = $payment->getCcNumberEnc();
		return $encryptedCc ? Mage::helper('core')->decrypt($encryptedCc) : null;
	}

	/**
	 * Decrypt the encrypted credit card number and return the first 6 digits.
	 *
	 * @param  Mage_Sales_Model_Order_Payment
	 * @return string | null
	 */
	public function getAccountBin(Mage_Sales_Model_Order_Payment $payment)
	{
		$cc = $this->_decryptCc($payment);
		return $this->getFirstSixChars($cc);
	}

	/**
	 * Get the first 6 characters from a passed in string
	 *
	 * @param  string
	 * @return string
	 */
	public function getFirstSixChars($string)
	{
		return $string ? substr($string, 0, 6) : $string;
	}

	/**
	 * Decrypt the encrypted credit card number
	 *
	 * @param  Mage_Sales_Model_Order_Payment $payment
	 * @return string | null
	 */
	public function getAccountUniqueId(Mage_Sales_Model_Order_Payment $payment)
	{
		$cc = $this->_decryptCc($payment);
		return $cc ? $cc : $payment->getCcNumber();
	}

	/**
	 * Return a hash and base64 encoded string of the passed in credit card number.
	 * @param  string $cc
	 * @return string
	 */
	public function hashAndEncodeCc($cc)
	{
		return base64_encode(hash('sha1', $cc, true));
	}

	/**
	 * @param  Mage_Sales_Model_Order_Payment
	 * @return string | null
	 */
	public function getPaymentExpireDate(Mage_Sales_Model_Order_Payment $payment)
	{
		$month = $payment->getCcExpMonth();
		$year = $payment->getCcExpYear();
		return ($year > 0 && $month > 0) ? $this->getYearMonth($year, $month) : null;
	}

	/**
	 * @param  string
	 * @param  string
	 * @return string
	 */
	public function getYearMonth($year, $month)
	{
		return $year . '-' . $this->_correctMonth($month);
	}

	/**
	 * @param  string
	 * @return string
	 */
	protected function _correctMonth($month)
	{
		return (strlen($month) === 1) ? sprintf('%02d', $month) : $month;
	}

	/**
	 * Determine if the passed order can be used to send feedback request.
	 *
	 * @param  Mage_Sales_Model_Order
	 * @return bool
	 */
	public function isOrderInAStateToSendFeedback(Mage_Sales_Model_Order $order)
	{
		return (
			$order->getState() === Mage_Sales_Model_Order::STATE_CANCELED
			|| $order->getState() === Mage_Sales_Model_Order::STATE_COMPLETE
		);
	}

	/**
	 * Determine if feedback request can be sent.
	 *
	 * @param  Mage_Sales_Model_Order
	 * @param  EbayEnterprise_Eb2cFraud_Model_Risk_Service
	 * @return bool
	 */
	public function canHandleFeedback(
		Mage_Sales_Model_Order $order,
		EbayEnterprise_Eb2cFraud_Model_Risk_Service $service
	)
	{
		return (
			$this->isOrderInAStateToSendFeedback($order)
			&& (bool) $service->getIsRequestSent() === true
			&& (bool) $service->getIsFeedbackSent() === false
			&& (int) $service->getFeedbackSentAttemptCount() < $this->_config->getFeedbackResendThreshold()
		);
	}

	/**
         * @param  string
         * @return self
         * @codeCoverageIgnore
         */
        public function logWarning($logMessage)
        {
                Mage::log($logMessage, Zend_Log::WARN);
                return $this;
        }

	/**
         * @param  string
         * @return self
         * @codeCoverageIgnore
         */
        public function logDebug($logMessage)
        {
                Mage::log($logMessage, Zend_Log::DEBUG);
                return $this;
        }
	
	/**
         * Scrub the auth request XML message of any sensitive data - CVV, CC number.
         * @param  string $xml
         * @return string
         */
        public function cleanAuthXml($xml)
        {
             $xml = preg_replace('#(\<(?:Encrypted)?CardSecurityCode\>).*(\</(?:Encrypted)?CardSecurityCode\>)#', '$1***$2', $xml);
             $xml = preg_replace('#(\<(?:Encrypted)?PaymentAccountUniqueId.*?\>).*(\</(?:Encrypted)?PaymentAccountUniqueId\>)#', '$1***$2', $xml);
             return $xml;
        }
}
