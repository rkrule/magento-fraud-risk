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

class EbayEnterprise_RiskService_Sdk_Shipment
	extends EbayEnterprise_RiskService_Sdk_Info
	implements EbayEnterprise_RiskService_Sdk_IShipment
{
	/** @var string */
	protected $_shipmentId;
	/** @var string */
	protected $_shippingMethod;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setPersonName($this->_buildPayloadForModel(static::PERSON_NAME_MODEL));
		$this->setTelephone($this->_buildPayloadForModel(static::TELEPHONE_MODEL));
		$this->setAddress($this->_buildPayloadForModel(static::ADDRESS_MODEL));
		$this->_extractionPaths = array(
			'setShipmentId' => 'string(@ShipmentId)',
			'setShippingMethod' => 'string(x:ShippingMethod)',
		);
		$this->_optionalExtractionPaths = array(
			'setEmail' => 'x:Email',
		);
		$this->_subpayloadExtractionPaths = array(
			'setPersonName' => 'x:PersonName',
			'setTelephone' => 'x:Telephone',
			'setAddress' => 'x:Address',
		);
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IShipment::getShipmentId()
	 */
	public function getShipmentId()
	{
		return $this->_shipmentId;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IShipment::setShipmentId()
	 */
	public function setShipmentId($shipmentId)
	{
		$this->_shipmentId = $shipmentId;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IShipment::getShippingMethod()
	 */
	public function getShippingMethod()
	{
		return $this->_shippingMethod;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IShipment::setShippingMethod()
	 */
	public function setShippingMethod($shippingMethod)
	{
		$this->_shippingMethod = $shippingMethod;
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
		return $this->getPersonName()->serialize()
			. $this->_serializeOptionalValue('Email', $this->getEmail())
			. $this->getTelephone()->serialize()
			. $this->getAddress()->serialize()
			. $this->_serializeNode('ShippingMethod', $this->getShippingMethod());
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_getRootAttributes()
	 */
	protected function _getRootAttributes()
	{
		return array(
			'ShipmentId' => $this->getShipmentId(),
		);
	}
}
