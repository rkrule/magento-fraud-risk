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

class EbayEnterprise_RiskService_Model_Risk_Fraud
	implements EbayEnterprise_RiskService_Model_Risk_IFraud
{
	/** @var Mage_Sales_Model_Order */
	protected $_order;
	/** @var EbayEnterprise_RiskService_Helper_Data */
	protected $_helper;

	/**
	 * @param array $initParams Must have this key:
	 *                          - 'order' => Mage_Sales_Model_Order
	 *                          - 'helper' => EbayEnterprise_RiskService_Helper_Data
	 */
	public function __construct(array $initParams=array())
	{
		list($this->_order, $this->_helper) = $this->_checkTypes(
			$this->_nullCoalesce($initParams, 'order', $initParams['order']),
			$this->_nullCoalesce($initParams, 'helper', Mage::helper('eb2cfraud'))
		);
	}

	/**
	 * Type hinting for self::__construct $initParams
	 *
	 * @param  Mage_Sales_Model_Order
	 * @param  EbayEnterprise_RiskService_Helper_Data
	 * @return array
	 */
	protected function _checkTypes(
		Mage_Sales_Model_Order $order,
		EbayEnterprise_RiskService_Helper_Data $helper
	) {
		return array($order, $helper);
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

	/**
	 * Get new risk instance loaded by passed in order increment id.
	 *
	 * @param  string
	 * @return EbayEnterprise_RiskService_Model_Risk_Insight
	 */
	protected function _getNewRiskServiceByOrderId($orderIncrementId)
	{
		return Mage::getModel('eb2cfraud/risk_service')
			->load($orderIncrementId, 'order_increment_id');
	}

	/**
	 * Get all risk insight data.
	 *
	 * @param  string
	 * @return array
	 */
	protected function _getRiskServiceData($orderIncrementId)
	{
		return array(
			'order_increment_id' => $orderIncrementId,
			'http_headers' => json_encode($this->_helper->getHeaderData()),
			'is_request_sent' => 0,
		);
	}

	/**
	 * Check if we have a valid order increment id
	 *
	 * @param  string
	 * @return bool
	 */
	protected function _canAddNewRiskServiceData($orderIncrementId)
	{
		if ($orderIncrementId === '') {
			$logMessage = sprintf('[%s] Received empty customer order id.', __CLASS__);
			Mage::log($logMessage, Zend_Log::WARN);
			return false;
		}
		return true;
	}

	public function process()
	{
		$orderIncrementId = trim($this->_order->getIncrementId());
		if ($this->_canAddNewRiskServiceData($orderIncrementId)) {
			$this->_getNewRiskServiceByOrderId($orderIncrementId)
				->addData($this->_getRiskServiceData($orderIncrementId))
				->save();
		}
		return $this;
	}
}
