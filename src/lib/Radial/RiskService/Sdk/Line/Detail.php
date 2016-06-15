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

class Radial_RiskService_Sdk_Line_Detail
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_Line_IDetail
{
	/** @var string **/
	protected $_SKU;
	/** @var integer **/
	protected $_quantity;
	/** @var string **/
	protected $_itemStatus;
	/** @var string **/
	protected $_trackingNumber;
	/** @var string **/
	protected $_shippingVendorCode;
	/** @var string **/
	protected $_deliveryMethod;
	/** @var string **/
	protected $_shipScheduledDate;
	/** @var string **/
	protected $_shipActualDate;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setSKU' => 'string(x:SKU)',
			'setQuantity' => 'number(x:Quantity)',
			'setItemStatus' => 'string(x:ItemStatus)',
		);
		$this->_optionalExtractionPaths = array(
			'setTrackingNumber' => 'x:TrackingNumber',
			'setShippingVendorCode' => 'x:ShippingVendorCode',
			'setDeliveryMethod' => 'x:DeliveryMethod',
		);
		$this->_dateTimeExtractionPaths = array(
                	'setShipScheduledDate' => 'string(x:ShipScheduledDate)',
                        'setShipActualDate' => 'string(x:ShipActualDate)',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IDetail::getSKU()
	 */
	public function getSKU()
	{
		return $this->_SKU;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IDetail::setSKU()
	 */
	public function setSKU($SKU)
	{
		$this->_SKU = $SKU;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_Line_IDetail::getQuantity()
         */
        public function getQuantity()
        {
                return $this->_quantity;
        }

        /**
         * @see Radial_RiskService_Sdk_Line_IDetail::setQuantity()
         */
        public function setQuantity($quantity)
        {
                $this->_quantity = $quantity;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_Line_IDetail::getItemStatus()
	 */
	public function getItemStatus()
	{
		return $this->_itemStatus;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IDetail::setItemStatus()
	 */
	public function setItemStatus($itemStatus)
	{
		$this->_itemStatus = $itemStatus;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IDetail::getTrackingNumber()
	 */
	public function getTrackingNumber()
	{
		return $this->_trackingNumber;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IDetail::setTrackingNumber()
	 */
	public function setTrackingNumber($trackingNumber)
	{
		$this->_trackingNumber = $trackingNumber;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IDetail::getShippingVendorCode()
	 */
	public function getShippingVendorCode()
	{
		return $this->_shippingVendorCode;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IDetail::setShippingVendorCode()
	 */
	public function setShippingVendorCode($shippingVendorCode)
	{
		$this->_shippingVendorCode = $shippingVendorCode;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_Line_IDetail::getDeliveryMethod()
         */
        public function getDeliveryMethod()
        {
                return $this->_deliveryMethod;
        }

        /**
         * @see Radial_RiskService_Sdk_Line_IDetail::setDeliveryMethod()
         */
        public function setDeliveryMethod($deliveryMethod)
        {
                $this->_deliveryMethod = $deliveryMethod;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_Line_IDetail::getShipScheduledDate()
	 */
	public function getShipScheduledDate()
	{
		return $this->_shipScheduledDate;
	}

	/**
	 * @see Radial_RiskService_Sdk_Line_IDetail::setShipScheduledDate()
	 */
	public function setShipScheduledDate(DateTime $shipScheduledDate)
	{
		$this->_shipScheduledDate = $shipScheduledDate;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_Line_IDetail::getShipActualDate()
         */
        public function getShipActualDate()
        {
                return $this->_shipActualDate;
        }

        /**
         * @see Radial_RiskService_Sdk_Line_IDetail::setShipActualDate()
         */
        public function setShipActualDate(DateTime $shipActualDate)
        {
                $this->_shipActualDate = $shipActualDate;
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
		return $this->_serializeNode('SKU', $this->getSKU())
			. $this->_serializeNode('Quantity', $this->getQuantity())
			. $this->_serializeNode('ItemStatus', $this->getItemStatus())
			. $this->_serializeOptionalValue('TrackingNumber', $this->getTrackingNumber())
			. $this->_serializeOptionalValue('ShippingVendorCode', $this->getShippingVendorCode())
			. $this->_serializeOptionalValue('DeliveryMethod', $this->getDeliveryMethod())
			. $this->_serializeOptionalDateValue('ShipScheduledDate', 'c', $this->getShipScheduledDate())
			. $this->_serializeOptionalDateValue('ShipActualDate', 'c', $this->getShipActualDate());
	}
}
