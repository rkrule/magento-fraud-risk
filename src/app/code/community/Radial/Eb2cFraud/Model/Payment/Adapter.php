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

class Radial_Eb2cFraud_Model_Payment_Adapter
	implements Radial_Eb2cFraud_Model_Payment_IAdapter
{
	/** @var Radial_Eb2cFraud_Model_Payment_Adapter_IType */
	protected $_adapter;
	/** @var Mage_Sales_Model_Order */
	protected $_order;
	/** @var Radial_Eb2cFraud_Helper_Data */
	protected $_helper;
	/** @var Radial_Eb2cFraud_Helper_Config */
	protected $_config;

	/**
	 * @param array $initParams Must have this key:
	 *                          - 'order' => Mage_Sales_Model_Order
	 *                          - 'helper' => Radial_Eb2cFraud_Helper_Data
	 *                          - 'config' => Radial_Eb2cFraud_Helper_Config
	 */
	public function __construct(array $initParams=array())
	{
		list($this->_order, $this->_helper, $this->_config) = $this->_checkTypes(
			$this->_nullCoalesce($initParams, 'order', $initParams['order']),
			$this->_nullCoalesce($initParams, 'helper', Mage::helper('radial_eb2cfraud')),
			$this->_nullCoalesce($initParams, 'config', Mage::helper('radial_eb2cfraud/config'))
		);
		$this->_adapter = $this->_getPaymentAdapter($this->_getAdapters());
	}

	/**
	 * Type hinting for self::__construct $initParams
	 *
	 * @param  Mage_Sales_Model_Order
	 * @param  Radial_Eb2cFraud_Helper_Data
	 * @param  Radial_Eb2cFraud_Helper_Config
	 * @return array
	 */
	protected function _checkTypes(
		Mage_Sales_Model_Order $order,
		Radial_Eb2cFraud_Helper_Data $helper,
		Radial_Eb2cFraud_Helper_Config $config
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
	 * @return Radial_Eb2cFraud_Model_Payment_Adapter_IType | null
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
