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

class Radial_RiskService_Sdk_Order
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_IOrder
{
	/** @var string */
	protected $_orderId;
    /** @var Radial_RiskService_Sdk_Customer_List */
    protected $_customerList;
	/** @var Radial_RiskService_Sdk_Shipping_List */
	protected $_shippingList;
	/** @var Radial_RiskService_Sdk_Line_Items */
	protected $_lineItems;
	/** @var Radial_RiskService_Sdk_ExternalRiskResults */
	protected $_externalRiskResults;
	/** @var Radial_RiskService_Sdk_Payments */
	protected $_formOfPayments;
	/** @var Radial_RiskService_Sdk_Total */
	protected $_totalCost;
    /** @var string */
    protected $_promoCode;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
        	$this->setCustomerList($this->_buildPayloadForModel(static::CUSTOMER_LIST_MODEL));
		$this->setShippingList($this->_buildPayloadForModel(static::SHIPPING_LIST_MODEL));
		$this->setLineItems($this->_buildPayloadForModel(static::LINE_ITEMS_MODEL));
        	$this->setExternalRiskResults($this->_buildPayloadForModel(static::EXTERNAL_RISK_RESULTS_MODEL));
		$this->setShoppingSession($this->_buildPayloadForModel(static::SHOPPING_SESSION_MODEL));
		$this->setTotalCost($this->_buildPayloadForModel(static::TOTAL_MODEL));
		$this->_extractionPaths = array(
			'setOrderId' => 'string(x:OrderId)',
		);
        $this->_optionalExtractionPaths = array (
            'setPromoCode' => 'x:PromoCode',
        );
		$this->_subpayloadExtractionPaths = array(
            'setCustomerList' => 'x:CustomerList',
			'setShippingList' => 'x:ShippingList',
			'setLineItems' => 'x:LineItems',
			'setExternalRiskResults' => 'x:ExternalRiskResults',
			'setShoppingSession' => 'x:ShoppingSession',
			'setTotalCost' => 'x:TotalCost',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_IOrder::getOrderId()
	 */
	public function getOrderId()
	{
		return $this->_orderId;
	}

	/**
	 * @see Radial_RiskService_Sdk_IOrder::setOrderId()
	 */
	public function setOrderId($orderId)
	{
		$this->_orderId = $orderId;
		return $this;
	}

    /**
     * @see Radial_RiskService_Sdk_IOrder::getPromoCode()
     */
    public function getPromoCode()
    {
        return $this->_promoCode;
    }

    /**
     * @see Radial_RiskService_Sdk_IOrder::setPromoCode()
     */
    public function setPromoCode($promoCode)
    {
        $this->_promoCode = $promoCode;
        return $this;
    }

    /**
     * @return Radial_RiskService_Sdk_Customer_IList
     */
    public function getCustomerList()
    {
        return $this->_customerList;
    }

    /**
     * @param  Radial_RiskService_Sdk_Customer_IList
     * @return self
     */
    public function setCustomerList(Radial_RiskService_Sdk_Customer_IList $customerList)
    {
        $this->_customerList = $customerList;
        return $this;
    }
	
    /**
     * @return Radial_RiskService_Sdk_IExternalRiskResults
     */
    public function getExternalRiskResults()
    {
	return $this->_externalRiskResults;
    }

    /**
     * @param  Radial_RiskService_Sdk_IExternalRiskResults
     * @return self
     */
    public function setExternalRiskResults(Radial_RiskService_Sdk_IExternalRiskResults $externalRiskResults)
    {
	$this->_externalRiskResults = $externalRiskResults;
	return $this;
    }

	/**
	 * @see Radial_RiskService_Sdk_IOrder::getShippingList()
	 */
	public function getShippingList()
	{
		return $this->_shippingList;
	}

	/**
	 * @see Radial_RiskService_Sdk_IOrder::setShippingList()
	 */
	public function setShippingList(Radial_RiskService_Sdk_Shipping_IList $shippingList)
	{
		$this->_shippingList = $shippingList;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_IOrder::getLineItems()
	 */
	public function getLineItems()
	{
		return $this->_lineItems;
	}

	/**
	 * @see Radial_RiskService_Sdk_IOrder::setLineItems()
	 */
	public function setLineItems(Radial_RiskService_Sdk_Line_IItems $lineItems)
	{
		$this->_lineItems = $lineItems;
		return $this;
	}

    /**
     * @see Radial_RiskService_Sdk_IOrder::getShoppingSession()
     */
    public function getShoppingSession()
    {
        return $this->_shoppingSession;
    }

    /**
     * @see Radial_RiskService_Sdk_IOrder::setShoppingSession()
     */
    public function setShoppingSession(Radial_RiskService_Sdk_IShoppingSession $shoppingSession)
    {
        $this->_shoppingSession = $shoppingSession;
        return $this;
    }

	/**
	 * @see Radial_RiskService_Sdk_IOrder::getTotalCost()
	 */
	public function getTotalCost()
	{
		return $this->_totalCost;
	}

	/**
	 * @see Radial_RiskService_Sdk_IOrder::setTotalCost()
	 */
	public function setTotalCost(Radial_RiskService_Sdk_ITotal $totalCost)
	{
		$this->_totalCost = $totalCost;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getRootNodeName()
	 */
	protected function _getRootNodeName()
	{
		return static::ROOT_NODE;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getXmlNamespace()
	 */
	protected function _getXmlNamespace()
	{
		return self::XML_NS;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_serializeContents()
	 */
	protected function _serializeContents()
	{
		return $this->_serializeNode('OrderId', $this->getOrderId())
			. $this->_serializeOptionalValue('PromoCode', $this->getPromoCode())
	                . $this->getCustomerList()->serialize()
			. $this->getShippingList()->serialize()
			. $this->getLineItems()->serialize()
			. $this->getExternalRiskResults()->serialize()
			. $this->getShoppingSession()->serialize()
			. $this->getTotalCost()->serialize();
	}
}
