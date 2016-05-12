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
    /** @var EbayEnterprise_RiskService_Sdk_Customer_List */
    protected $_customerList;
	/** @var EbayEnterprise_RiskService_Sdk_Shipping_List */
	protected $_shippingList;
	/** @var EbayEnterprise_RiskService_Sdk_Line_Items */
	protected $_lineItems;
	/** @var EbayEnterprise_RiskService_Sdk_Payments */
	protected $_formOfPayments;
	/** @var EbayEnterprise_RiskService_Sdk_Total */
	protected $_totalCost;
    /** @var string */
    protected $_promoCode;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
        $this->setCustomerList($this->_buildPayloadForModel(static::CUSTOMER_LIST_MODEL));
		$this->setShippingList($this->_buildPayloadForModel(static::SHIPPING_LIST_MODEL));
		$this->setLineItems($this->_buildPayloadForModel(static::LINE_ITEMS_MODEL));
        $this->setShoppingSession($this->_buildPayloadForModel(static::SHOPPING_SESSION_MODEL));
		$this->setTotalCost($this->_buildPayloadForModel(static::TOTAL_MODEL));
		$this->_extractionPaths = array(
			'setOrderId' => 'string(x:OrderId)',
		);
        $this->_optionalExtractionPaths = array (
            'setPromoCode' => 'string(x:PromoCode)',
        );
		$this->_subpayloadExtractionPaths = array(
            'setCustomerList' => 'x:CustomerList',
			'setShippingList' => 'x:ShippingList',
			'setLineItems' => 'x:LineItems',
			'setShoppingSession' => 'x:ShoppingSession',
			'setTotalCost' => 'x:TotalCost',
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
     * @see EbayEnterprise_RiskService_Sdk_IOrder::getPromoCode()
     */
    public function getPromoCode()
    {
        return $this->_promoCode;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_IOrder::setPromoCode()
     */
    public function setPromoCode($promoCode)
    {
        $this->_promoCode = $promoCode;
        return $this;
    }

    /**
     * @return EbayEnterprise_RiskService_Sdk_Customer_IList
     */
    public function getCustomerList()
    {
        return $this->_customerList;
    }

    /**
     * @param  EbayEnterprise_RiskService_Sdk_Customer_IList
     * @return self
     */
    public function setCustomerList(EbayEnterprise_RiskService_Sdk_Customer_IList $customerList)
    {
        $this->_customerList = $customerList;
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
     * @see EbayEnterprise_RiskService_Sdk_IOrder::getShoppingSession()
     */
    public function getShoppingSession()
    {
        return $this->_shoppingSession;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_IOrder::setShoppingSession()
     */
    public function setShoppingSession(EbayEnterprise_RiskService_Sdk_IShoppingSession $shoppingSession)
    {
        $this->_shoppingSession = $shoppingSession;
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
			. $this->_serializeOptionalValue('PromoCode', $this->getPromoCode())
            . $this->getCustomerList()->serialize()
			. $this->getShippingList()->serialize()
			. $this->getLineItems()->serialize()
			. $this->getShoppingSession()->serialize()
			. $this->getTotalCost()->serialize();
	}
}
