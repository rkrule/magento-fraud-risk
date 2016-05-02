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

/**
 * @codeCoverageIgnore
 */
class EbayEnterprise_RiskService_Helper_Config
{
	const ENABLED = 'ebayenterprise_riskinsight/risk_insight/enabled';
	const STORE_ID = 'ebayenterprise_riskinsight/risk_insight/store_id';
	const API_HOSTNAME = 'ebayenterprise_riskinsight/risk_insight/hostname';
	const API_KEY = 'ebayenterprise_riskinsight/risk_insight/key';
	const API_TIMEOUT = 'ebayenterprise_riskinsight/risk_insight/timeout';
	const DEBUG = 'ebayenterprise_riskinsight/risk_insight/debug';
	const ORDER_SOURCE = 'ebayenterprise_riskinsight/risk_insight/order_source';
	const HIGH_RESPONSE_ACTION = 'ebayenterprise_riskinsight/risk_insight/high_action';
	const MEDIUM_RESPONSE_ACTION = 'ebayenterprise_riskinsight/risk_insight/medium_action';
	const LOW_RESPONSE_ACTION = 'ebayenterprise_riskinsight/risk_insight/low_action';
	const UNKNOWN_RESPONSE_ACTION = 'ebayenterprise_riskinsight/risk_insight/unknown_action';
	const LANGUAGE_CODE = 'ebayenterprise_riskinsight/risk_insight/language_code';
	const CARD_TYPE_MAP = 'ebayenterprise_riskinsight/risk_insight/card_type_map';
	const SHIPPING_METHOD_MAP = 'ebayenterprise_riskinsight/risk_insight/shipping_method_map';
	const PAYMENT_ADAPTER_MAP = 'ebayenterprise_riskinsight/risk_insight/payment_adapter_map';
	const FEEDBACK_RESEND_THRESHOLD = 'ebayenterprise_riskinsight/risk_insight/feedback_request_resend_threshold';

	/**
	 * check if Risk Insight module is enable in the store config
	 *
	 * @param  mixed
	 * @return bool
	 */
	public function isEnabled($store=null)
	{
		return Mage::getStoreConfigFlag(static::ENABLED, $store);
	}

	/**
	 * check if debug mode is enable in the store config
	 *
	 * @param  mixed
	 * @return bool
	 */
	public function isDebugMode($store=null)
	{
		return Mage::getStoreConfigFlag(static::DEBUG, $store);
	}

	/**
	 * retrieve the FraudNet Store id from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getStoreId($store=null)
	{
		return Mage::getStoreConfig(static::STORE_ID, $store);
	}

	/**
	 * retrieve the language code from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getLanguageCodeId($store=null)
	{
		return Mage::getStoreConfig(static::LANGUAGE_CODE, $store);
	}

	/**
	 * retrieve the API Host Name from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getApiHostname($store=null)
	{
		return Mage::getStoreConfig(static::API_HOSTNAME, $store);
	}

	/**
	 * retrieve the API encrypted key from store config and decrypt it.
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getApiKey($store=null)
	{
		return Mage::helper('core')->decrypt(Mage::getStoreConfig(static::API_KEY, $store));
	}

	/**
	 * retrieve the API timeout setting from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getApiTimeout($store=null)
	{
		return Mage::getStoreConfig(static::API_TIMEOUT, $store);
	}

	/**
	 * retrieve the order source override setting from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getOrderSource($store=null)
	{
		return Mage::getStoreConfig(static::ORDER_SOURCE, $store);
	}

	/**
	 * retrieve the high response action settings from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getHighResponseAction($store=null)
	{
		return Mage::getStoreConfig(static::HIGH_RESPONSE_ACTION, $store);
	}

	/**
	 * retrieve the medium response action settings from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getMediumResponseAction($store=null)
	{
		return Mage::getStoreConfig(static::MEDIUM_RESPONSE_ACTION, $store);
	}

	/**
	 * retrieve the low response action settings from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getLowResponseAction($store=null)
	{
		return Mage::getStoreConfig(static::LOW_RESPONSE_ACTION, $store);
	}

	/**
	 * retrieve the unknown response action settings from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getUnknownResponseAction($store=null)
	{
		return Mage::getStoreConfig(static::UNKNOWN_RESPONSE_ACTION, $store);
	}

	/**
	 * retrieve the payment method card type map settings from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getPaymentMethodCardTypeMap($store=null)
	{
		return Mage::getStoreConfig(static::CARD_TYPE_MAP, $store);
	}

	/**
	 * retrieve the shipping method map settings from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getShippingMethodMap($store=null)
	{
		return Mage::getStoreConfig(static::SHIPPING_METHOD_MAP, $store);
	}

	/**
	 * retrieve the payment adapter map settings from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getPaymentAdapterMap($store=null)
	{
		return Mage::getStoreConfig(static::PAYMENT_ADAPTER_MAP, $store);
	}

	/**
	 * retrieve the feedback request resend threshold settings from store config
	 *
	 * @param  mixed
	 * @return int
	 */
	public function getFeedbackResendThreshold($store=null)
	{
		return (int) Mage::getStoreConfig(static::FEEDBACK_RESEND_THRESHOLD, $store);
	}
}
