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

class Radial_RiskService_Sdk_Shipment
	extends Radial_RiskService_Sdk_Info
	implements Radial_RiskService_Sdk_IShipment
{
	/** @var string */
	protected $_shipmentId;
	/** @var string */
	protected $_addressId;
	/** @var string */
	protected $_shippingMethod;
	/** @var Radial_RiskService_Sdk_Cost_Totals */
	protected $_costTotals;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setCostTotals($this->_buildPayloadForModel(static::COST_TOTALS_MODEL));
		$this->_extractionPaths = array(
			'setShipmentId' => 'string(@ShipmentId)',
			'setAddressId'  => 'string(@AddressId)',
			'setShippingMethod' => 'string(x:ShippingMethod)',
		);
		$this->_subpayloadExtractionPaths = array(
			'setCostTotals' => 'x:CostTotals',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_IShipment::getShipmentId()
	 */
	public function getShipmentId()
	{
		return $this->_shipmentId;
	}

	/**
	 * @see Radial_RiskService_Sdk_IShipment::setShipmentId()
	 */
	public function setShipmentId($shipmentId)
	{
		$this->_shipmentId = $shipmentId;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_IShipment::getAddressId()
         */
        public function getAddressId()
        {
                return $this->_addressId;
        }

        /**
         * @see Radial_RiskService_Sdk_IShipment::setAddressId()
         */
        public function setAddressId($addressId)
        {
                $this->_addressId = $addressId;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_IShipment::getShippingMethod()
	 */
	public function getShippingMethod()
	{
		return $this->_shippingMethod;
	}

	/**
	 * @see Radial_RiskService_Sdk_IShipment::setShippingMethod()
	 */
	public function setShippingMethod($shippingMethod)
	{
		$this->_shippingMethod = $shippingMethod;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_ITotal::getCostTotals()
	 */
	public function getCostTotals()
	{
		return $this->_costTotals;
	}

	/**
	 * @see Radial_RiskService_Sdk_ITotal::setCostTotals()
	 */
	public function setCostTotals(Radial_RiskService_Sdk_Cost_ITotals $costTotals)
	{
		$this->_costTotals = $costTotals;
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
		return $this->getCostTotals()->serialize()
			. $this->_serializeNode('ShippingMethod', $this->getShippingMethod());
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getRootAttributes()
	 */
	protected function _getRootAttributes()
	{
		return array(
			'AddressId'  => $this->getAddressId(),
			'ShipmentId' => $this->getShipmentId(),
		);
	}
}
