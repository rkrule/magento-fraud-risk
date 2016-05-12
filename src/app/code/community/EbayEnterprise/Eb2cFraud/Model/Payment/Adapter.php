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

class EbayEnterprise_Eb2cFraud_Model_Payment_Adapter
	implements EbayEnterprise_Eb2cFraud_Model_Payment_IAdapter
{
	/** @var EbayEnterprise_Eb2cFraud_Model_Payment_Adapter_IType */
	protected $_adapter;
	/** @var Mage_Sales_Model_Order */
	protected $_order;
	/** @var EbayEnterprise_Eb2cFraud_Helper_Data */
	protected $_helper;
	/** @var EbayEnterprise_Eb2cFraud_Helper_Config */
	protected $_config;

	/**
	 * @param array $initParams Must have this key:
	 *                          - 'order' => Mage_Sales_Model_Order
	 *                          - 'helper' => EbayEnterprise_Eb2cFraud_Helper_Data
	 *                          - 'config' => EbayEnterprise_Eb2cFraud_Helper_Config
	 */
	public function __construct(array $initParams=array())
	{
		list($this->_order, $this->_helper, $this->_config) = $this->_checkTypes(
			$this->_nullCoalesce($initParams, 'order', $initParams['order']),
			$this->_nullCoalesce($initParams, 'helper', Mage::helper('eb2cfraud')),
			$this->_nullCoalesce($initParams, 'config', Mage::helper('eb2cfraud/config'))
		);
		$this->_adapter = $this->_getPaymentAdapter($this->_getAdapters());
	}

	/**
	 * Type hinting for self::__construct $initParams
	 *
	 * @param  Mage_Sales_Model_Order
	 * @param  EbayEnterprise_Eb2cFraud_Helper_Data
	 * @param  EbayEnterprise_Eb2cFraud_Helper_Config
	 * @return array
	 */
	protected function _checkTypes(
		Mage_Sales_Model_Order $order,
		EbayEnterprise_Eb2cFraud_Helper_Data $helper,
		EbayEnterprise_Eb2cFraud_Helper_Config $config
	) {
		return array($order, $helper, $config);
	}

	/**
	 * Return the value at field in array if it exists. Otherwise, use the default value.
	 *
	 * @param  array
	 * @param  string | int $field Valid array key
	 * @param  mixed
	 * @return mixed
	 */
	protected function _nullCoalesce(array $arr, $field, $default)
	{
		return isset($arr[$field]) ? $arr[$field] : $default;
	}

	public function getAdapter()
	{
		return $this->_adapter;
	}

	/**
	 * @return array
	 */
	protected function _getAdapters()
	{
		return $this->_config->getPaymentAdapterMap();
	}

	/**
	 * @return EbayEnterprise_Eb2cFraud_Model_Payment_Adapter_IType | null
	 */
	protected function _getPaymentAdapter()
	{
		return Mage::getModel($this->_getAdapterModel(), array('order' => $this->_order));
	}

	/**
	 * @return string
	 */
	protected function _getAdapterModel()
	{
		$adapters = $this->_getAdapters();
		$method = $this->_getMethod();
		return (isset($adapters[$method]) && $adapters[$method])
			? $adapters[$method] : static::DEFAULT_ADAPTER;
	}

	/**
	 * @return string
	 */
	public function _getMethod()
	{
		$payment = $this->_order->getPayment();
		return $this->_helper->isGiftCardPayment($this->_order, $payment)
			? static::GIFT_CARD_PAYMENT_METHOD : $payment->getMethod();
	}
}
