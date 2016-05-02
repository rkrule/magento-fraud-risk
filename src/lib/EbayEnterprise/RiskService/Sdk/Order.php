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

class EbayEnterprise_RiskService_Sdk_Order
	extends EbayEnterprise_RiskService_Sdk_Payload
	implements EbayEnterprise_RiskService_Sdk_IOrder
{
	/** @var string */
	protected $_orderId;
	/** @var string */
	protected $_promotionCode;
	/** @var EbayEnterprise_RiskService_Sdk_Shipping_List */
	protected $_shippingList;
	/** @var EbayEnterprise_RiskService_Sdk_Line_Items */
	protected $_lineItems;
	/** @var EbayEnterprise_RiskService_Sdk_Total */
	protected $_totalCost;
	/** @var EbayEnterprise_RiskService_Sdk_Info */
	protected $_customerList;
	/** @var EbayEnterprise_RiskService_Sdk_ExternalRiskResults */
	protected $_externalRiskResults;
	/** @var EbayEnterprise_RiskService_Sdk_ShoppingSession */
	protected $_shoppingSession;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setShippingList($this->_buildPayloadForModel(static::SHIPPING_LIST_MODEL));
		$this->setLineItems($this->_buildPayloadForModel(static::LINE_ITEMS_MODEL));
		$this->setTotalCost($this->_buildPayloadForModel(static::TOTAL_MODEL));
		$this->setCustomerList($this->_buildPayloadForModel(static::CUSTOMER_LIST_MODEL));
		$this->setExternalRiskResults($this->_buildPayloadForModel(static::EXTERNAL_RISK_RESULTS_MODEL));
		$this->setShoppingSession($this->_buildPayloadForModel(static::SHOPPING_SESSION_MODEL));
		$this->_extractionPaths = array(
			'setOrderId' => 'string(x:OrderId)',
			'setPromotionCode' => 'string(x:PromotionCode)',
		);
		$this->_subpayloadExtractionPaths = array(
			'setShippingList' => 'x:ShippingList',
			'setLineItems' => 'x:LineItems',
			'setTotalCost' => 'x:TotalCost',
			'setCustomerList' => 'x:CustomerList',
			'setExternalRiskResults' => 'x:ExternalRiskResults',
			'setShoppingSession' => 'x:ShoppingSession',
		);
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IOrder::getOrderId()
	 */
	public function getOrderId()
	{
		return $this->_orderId;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IOrder::setOrderId()
	 */
	public function setOrderId($orderId)
	{
		$this->_orderId = $orderId;
		return $this;
	}

	/**
         * @see EbayEnterprise_RiskService_Sdk_IOrder::getPromotionCode()
         */
        public function getPromotionCode()
        {
                return $this->_promotionCode;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IOrder::setPromotionCode()
         */
        public function setPromotionCode($promotionCode)
        {
                $this->_promotionCode = $promotionCode;
                return $this;
        }

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IOrder::getShippingList()
	 */
	public function getShippingList()
	{
		return $this->_shippingList;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IOrder::setShippingList()
	 */
	public function setShippingList(EbayEnterprise_RiskService_Sdk_Shipping_IList $shippingList)
	{
		$this->_shippingList = $shippingList;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IOrder::getLineItems()
	 */
	public function getLineItems()
	{
		return $this->_lineItems;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IOrder::setLineItems()
	 */
	public function setLineItems(EbayEnterprise_RiskService_Sdk_Line_IItems $lineItems)
	{
		$this->_lineItems = $lineItems;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IOrder::getTotalCost()
	 */
	public function getTotalCost()
	{
		return $this->_totalCost;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IOrder::setTotalCost()
	 */
	public function setTotalCost(EbayEnterprise_RiskService_Sdk_ITotal $totalCost)
	{
		$this->_totalCost = $totalCost;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IOrder::getCustomerList()
	 */
	public function getCustomerList()
	{
		return $this->_customerList;
	}

	/**
         * @see EbayEnterprise_RiskService_Sdk_IOrder::setCustomerList()
         */
        public function setCustomerList(EbayEnterprise_RiskService_Sdk_IInfo $customerList)
        {
                $this->_customerList = $customerList;
                return $this;
        }

	/**
         * @return EbayEnterprise_RiskService_Sdk_IExternalRiskResults
         */
        public function getExternalRiskResults()
	{
		return $this->_externalRiskResults;
	}

        /**
         * @param  EbayEnterprise_RiskService_Sdk_IExternalRiskResults
         * @return self
         */
        public function setExternalRiskResults(EbayEnterprise_RiskService_Sdk_IExternalRiskResults $externalRiskResults)
	{
		$this->_externalRiskResults = $externalRiskResults;
		return $this;
	}

	/**
         * @return EbayEnterprise_RiskService_Sdk_IShoppingSession
         */
        public function getShoppingSession()
	{
		return $this->_shoppingSession;
	}

        /**
         * @param  EbayEnterprise_RiskService_Sdk_IShoppingSession
         * @return self
         */
        public function setShoppingSession(EbayEnterprise_RiskService_Sdk_IShoppingSession $shoppingSession)
	{
		$this->_shoppingSession = $shoppingSession;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_getRootNodeName()
	 */
	protected function _getRootNodeName()
	{
		return static::ROOT_NODE;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_getXmlNamespace()
	 */
	protected function _getXmlNamespace()
	{
		return self::XML_NS;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_serializeContents()
	 */
	protected function _serializeContents()
	{
		return $this->_serializeNode('OrderId', $this->getOrderId())
			. $this->_serializeOptionalValue('OrderSource', $this->getOrderSource())
			. $this->_serializeNode('OrderDate', $this->getOrderDate()->format('c'))
			. $this->_serializeNode('StoreId', $this->getStoreId())
			. $this->getShippingList()->serialize()
			. $this->getLineItems()->serialize()
			. $this->getCustomerList()->serialize()
			. $this->getTotalCost()->serialize()
			. $this->getExternalRiskResults()->serialize()
			. $this->getShoppingSession()->serialize();
	}
}
