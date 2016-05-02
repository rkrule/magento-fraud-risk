<?php
/**
 * Copyright (c) 2013-2014 eBay Enterprise, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @copyright   Copyright (c) 2013-2014 eBay Enterprise, Inc. (http://www.ebayenterprise.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class EbayEnterprise_Eb2cFraud_Model_Observer
{
	/** @var EbayEnterprise_RiskService_Helper_Data */
	protected $_helper;
	/** @var EbayEnterprise_RiskService_Helper_Config */
	protected $_config;

	/**
	 * @param array $initParams optional keys:
	 *                          - 'helper' => EbayEnterprise_RiskService_Helper_Data
	 *                          - 'config' => EbayEnterprise_RiskService_Helper_Config
	 */
	public function __construct(array $initParams=array())
	{
		list($this->_helper, $this->_config) = $this->_checkTypes(
			$this->_nullCoalesce($initParams, 'helper', Mage::helper('eb2cfraud')),
			$this->_nullCoalesce($initParams, 'config', Mage::helper('eb2cfraud/config'))
		);
	}

	/**
	 * Type checks for self::__construct $initParams
	 *
	 * @param  EbayEnterprise_RiskService_Helper_Data
	 * @param  EbayEnterprise_RiskService_Helper_Config
	 * @return array
	 */
	protected function _checkTypes(
		EbayEnterprise_RiskService_Helper_Data $helper,
		EbayEnterprise_RiskService_Helper_Config $config
	) {
		return array($helper, $config);
	}
	/**
	 * Return the value at field in array if it exists. Otherwise, use the
	 * default value.
	 *
	 * @param array      $arr
	 * @param string|int $field Valid array key
	 * @param mixed      $default
	 * @return mixed
	 */
	protected function _nullCoalesce(array $arr, $field, $default)
	{
		return isset($arr[$field]) ? $arr[$field] : $default;
	}

	/**
	 * @param  Mage_Sales_Model_Order
	 * @return self
	 */
	protected function _handleProcessOrder(Mage_Sales_Model_Order $order)
	{
		Mage::getModel('eb2cfraud/risk_fraud', array(
			'order' => $order,
			'helper' => $this->_helper,
		))->process();
		return $this;
	}

	/**
	 * @param  mixed
	 * @return bool
	 */
	protected function _isValidOrder($order=null)
	{
		return ($order && $order instanceof Mage_Sales_Model_Order);
	}

	/**
	 * @param  string
	 * @return self
	 * @codeCoverageIgnore
	 */
	protected function _logWarning($logMessage)
	{
		Mage::log($logMessage, Zend_Log::WARN);
		return $this;
	}

	/**
	 * Consume the event 'sales_model_service_quote_submit_after'. Pass the Mage_Sales_Model_Order object
	 * from the event down to the 'eb2cfraud/risk_fraud' instance. Invoke the process
	 * method on the 'eb2cfraud/risk_fraud' instance.
	 *
	 * @param  Varien_Event_Observer
	 * @return self
	 */
	public function handleSalesModelServiceQuoteSubmitAfter(Varien_Event_Observer $observer)
	{
		$order = $observer->getEvent()->getOrder();
		if ($this->_isValidOrder($order)) {
			$this->_handleProcessOrder($order);
		} else {
			$logMessage = sprintf('[%s] No sales/order instance was found.', __CLASS__);
			$this->_logWarning($logMessage);
		}
		return $this;
	}

	/**
	 * @param  array
	 * @return self
	 */
	protected function _handleProcessMultipleOrders(array $orders)
	{
		foreach ($orders as $index => $order) {
			if ($this->_isValidOrder($order)) {
				$this->_handleProcessOrder($order);
			} else {
				$logMessage = sprintf('[%s] Multi-shipping order index %d was not a valid instance of sales/order class.', __CLASS__, $index);
				$this->_logWarning($logMessage);
			}
		}
		return $this;
	}

	/**
	 * Handle multi-shipping orders.
	 *
	 * @param  Varien_Event_Observer
	 * @return self
	 */
	public function handleCheckoutSubmitAllAfter(Varien_Event_Observer $observer)
	{
		$orders = (array) $observer->getEvent()->getOrders();
		if (!empty($orders)) {
			$this->_handleProcessMultipleOrders($orders);
		} else {
			$logMessage = sprintf('[%s] No multi-shipping sales/order instances was found.', __CLASS__);
			$this->_logWarning($logMessage);
		}
		return $this;
	}

	/**
	 * Consume the event 'sales_order_save_after'. Get the sales/order object
	 * from the event. Validate we have a valid sales/order object, then pass it
	 * down to self::_processOrderFeedback() protected method. If we don't have
	 * a valid sales/order object we simply log a warning message.
	 *
	 * @param  Varien_Event_Observer
	 * @return self
	 */
	public function handleSalesOrderSaveAfter(Varien_Event_Observer $observer)
	{
		$order = $observer->getEvent()->getOrder();
		if ($this->_isValidOrder($order)) {
			$this->_handleOrderFeedback($order);
		} else {
			$logMessage = sprintf('[%s] No sales/order instance was found to send risk feedback request.', __CLASS__);
			$this->_logWarning($logMessage);
		}
		return $this;
	}
}
