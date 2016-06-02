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

class Radial_RiskService_Sdk_OrderConfirmationRequest
	extends Radial_RiskService_Sdk_Payload_Top
	implements Radial_RiskService_Sdk_IOrderConfirmationRequest
{
	/** @var Radial_RiskService_Sdk_IOCROrder **/
	protected $_order;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setOrder($this->_buildPayloadForModel(static::ORDER_MODEL));
		$this->_subpayloadExtractionPaths = array(
			'setOrder' => 'x:Order',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::getOrder()
	 */
	public function getOrder()
	{
		return $this->_order;
	}

	/**
	 * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::setOrder()
	 */
	public function setOrder(Radial_RiskService_Sdk_IOCROrder $order)
	{
		$this->_order = $order;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload_Top::_getSchemaFile()
	 */
	protected function _getSchemaFile()
	{
		return $this->_getSchemaDir() . self::XSD;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getXmlNamespace()
	 */
	protected function _getXmlNamespace()
	{
		return static::XML_NS;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getRootNodeName()
	 */
	protected function _getRootNodeName()
	{
		return static::ROOT_NODE;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_serializeContents()
	 */
	protected function _serializeContents()
	{
		return $this->getOrder()->serialize();
	}
}
