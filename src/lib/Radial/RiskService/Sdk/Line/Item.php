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

class Radial_RiskService_Sdk_Line_Item
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_Line_IItem
{
	/** @var string */
	protected $_lineItemId;
	/** @var string */
	protected $_shipmentId;
	/** @var string */
	protected $_productId;
	/** @var string */
	protected $_description;
	/** @var float */
	protected $_unitCost;
	/** @var int */
	protected $_quantity;
	/** @var string */
	protected $_category;
	/** @var string */
	protected $_promoCode;
	/** @var float */
	protected $_lineTotalAmount;
	/** @var float */
	protected $_unitWeight;
	/** @var string */
	protected $_unitOfMeasure;
	/** @var string */
	protected $_unitCurrencyCode;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setLineItemId' => 'string(@LineItemId)',
			'setShipmentId' => 'string(@ShipmentId)',
			'setLineTotalAmount' => 'number(x:LineTotalAmount)',
			'setQuantity' => 'number(x:Quantity)',
		);
		$this->_optionalExtractionPaths = array(
			'setUnitCost' => 'x:UnitCostAmount',
			'setProductName' => 'x:ProductName',
			'setDescription' => 'x:ProductDescription',
			'setUnitWeight' =>  'x:UnitWeight',
			'setUnitOfMeasure' => 'x:UnitWeight/@unit',
			'setUnitCurrencyCode' => 'x:LineTotalAmount/@currencyCode',
			'setCategory' => 'x:ProductCategory',
			'setPromoCode' => 'x:PromoCode',
			'setProductId' => 'x:ItemId',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::getUnitCurrencyCode()
	 */
	public function getUnitCurrencyCode()
	{
		return $this->_unitCurrencyCode;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::setUnitCurrencyCode()
	 */
	public function setUnitCurrencyCode($unitCurrencyCode)
	{
		$this->_unitCurrencyCode = $unitCurrencyCode;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::getLineItemId()
	 */
	public function getLineItemId()
	{
		return $this->_lineItemId;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::setLineItemId()
	 */
	public function setLineItemId($lineItemId)
	{
		$this->_lineItemId = $lineItemId;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::getShipmentId()
	 */
	public function getShipmentId()
	{
		return $this->_shipmentId;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::setShipmentId()
	 */
	public function setShipmentId($shipmentId)
	{
		$this->_shipmentId = $shipmentId;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::getProductId()
	 */
	public function getProductId()
	{
		return $this->_productId;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::setProductId()
	 */
	public function setProductId($productId)
	{
		$this->_productId = $productId;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_Line_IItem::getProductName()
         */
        public function getProductName()
        {
                return $this->_productName;
        }

        /**
         * @see Radial_RiskService_Sdk_Line_IItem::setProductName()
         */
        public function setProductName($productName)
        {
                $this->_productName = $productName;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::getDescription()
	 */
	public function getDescription()
	{
		return $this->_description;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::setDescription()
	 */
	public function setDescription($description)
	{
		$this->_description = $description;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_Line_IItem::getLineTotalAmount()
         */
        public function getLineTotalAmount()
        {
                return $this->_lineTotalAmount;
        }

        /**
         * @see Radial_RiskService_Sdk_Line_IItem::setLineTotalAmount()
         */
        public function setLineTotalAmount($lineTotalAmount)
        {
                $this->_lineTotalAmount = $lineTotalAmount;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::getUnitCost()
	 */
	public function getUnitCost()
	{
		return $this->_unitCost;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::setUnitCost()
	 */
	public function setUnitCost($unitCost)
	{
		$this->_unitCost = $unitCost;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_Line_IItem::getUnitWeight()
         */
        public function getUnitWeight()
        {
                return $this->_unitWeight;
        }

        /**
         * @see Radial_RiskService_Sdk_Line_IItem::setUnitWeight()
         */
        public function setUnitWeight($unitWeight)
        {
                $this->_unitWeight = $unitWeight;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::getQuantity()
	 */
	public function getQuantity()
	{
		return $this->_quantity;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::setQuantity()
	 */
	public function setQuantity($quantity)
	{
		$this->_quantity = $quantity;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::getCategory()
	 */
	public function getCategory()
	{
		return $this->_category;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::setCategory()
	 */
	public function setCategory($category)
	{
		$this->_category = $category;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::getPromoCode()
	 */
	public function getPromoCode()
	{
		return $this->_promoCode;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IItem::setPromoCode()
	 */
	public function setPromoCode($promoCode)
	{
		$this->_promoCode = $promoCode;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_Line_IItem::getUnitOfMeasure()
         */
        public function getUnitOfMeasure()
        {
                return $this->_unitOfMeasure;
        }

        /**
         * @see Radial_RiskService_Sdk_Line_IItem::setUnitOfMeasure()
         */
        public function setUnitOfMeasure($unitOfMeasure)
        {
                $this->_unitOfMeasure = $unitOfMeasure;
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
		return $this->_serializeAmountNode('LineTotalAmount', $this->getLineTotalAmount(), $this->_unitCurrencyCode)
			. $this->_serializeOptionalAmount('UnitCostAmount', $this->getUnitCost(), $this->_unitCurrencyCode)
			. $this->_serializeNode('Quantity', $this->getQuantity())
			. $this->_serializeOptionalValue('ProductName', $this->getProductName())
			. $this->_serializeOptionalValue('ProductDescription', $this->getDescription())
			. $this->_serializeWeight()
			. $this->_serializeOptionalValue('ProductCategory', $this->getCategory())
			. $this->_serializeOptionalValue('PromoCode', $this->getPromoCode())
			. $this->_serializeOptionalValue('ItemId', $this->getProductId());
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getRootAttributes()
	 */
	protected function _getRootAttributes()
	{
		return array(
			'LineItemId' => $this->getLineItemId(),
			'ShipmentId' => $this->getShipmentId(),
		);
	}

	/**
	 * Serialize the Unit Weight
	 *
	 * @return string
	 */
	protected function _serializeWeight()
	{
		$unitOfMeasure = $this->getUnitOfMeasure();
		$unitWeight = $this->getUnitWeight();
		return $unitWeight ? "<UnitWeight unit=\"{$unitOfMeasure}\">{$unitWeight}</UnitWeight>" : '';
	}	
}
