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

class Radial_RiskService_Sdk_Feedback_Response
	extends Radial_RiskService_Sdk_Payload_Top
	implements Radial_RiskService_Sdk_Feedback_IResponse
{
	/** @var string */
	protected $_primaryLangId;
	/** @var string */
	protected $_orderId;
	/** @var string */
	protected $_storeId;
	/** @var string */
	protected $_actionTakenAcknowledgement;
	/** @var string */
	protected $_chargeBackAcknowledgement;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setOrderId' => 'string(x:OrderId)',
			'setStoreId' => 'string(x:StoreId)',
		);
		$this->_optionalExtractionPaths = array(
			'setPrimaryLangId' => 'x:PrimaryLangId',
			'setActionTakenAcknowledgement' => 'x:ActionTakenAcknowledgement',
			'setChargeBackAcknowledgement' => 'x:ChargeBackAcknowledgement',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_Feedback_IResponse::getPrimaryLangId()
	 */
	public function getPrimaryLangId()
	{
		return $this->_primaryLangId;
	}

	/**
	 * @see Radial_RiskService_Sdk_Feedback_IResponse::setPrimaryLangId()
	 */
	public function setPrimaryLangId($primaryLangId)
	{
		$this->_primaryLangId = $primaryLangId;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Feedback_IResponse::getOrderId()
	 */
	public function getOrderId()
	{
		return $this->_orderId;
	}

	/**
	 * @see Radial_RiskService_Sdk_Feedback_IResponse::setOrderId()
	 */
	public function setOrderId($orderId)
	{
		$this->_orderId = $orderId;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Feedback_IResponse::getStoreId()
	 */
	public function getStoreId()
	{
		return $this->_storeId;
	}

	/**
	 * @see Radial_RiskService_Sdk_Feedback_IResponse::setStoreId()
	 */
	public function setStoreId($storeId)
	{
		$this->_storeId = $storeId;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Feedback_IResponse::getActionTakenAcknowledgement()
	 */
	public function getActionTakenAcknowledgement()
	{
		return $this->_actionTakenAcknowledgement;
	}

	/**
	 * @see Radial_RiskService_Sdk_Feedback_IResponse::setActionTakenAcknowledgement()
	 */
	public function setActionTakenAcknowledgement($actionTakenAcknowledgement)
	{
		$this->_actionTakenAcknowledgement = $actionTakenAcknowledgement;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Feedback_IResponse::getChargeBackAcknowledgement()
	 */
	public function getChargeBackAcknowledgement()
	{
		return $this->_chargeBackAcknowledgement;
	}

	/**
	 * @see Radial_RiskService_Sdk_Feedback_IResponse::setChargeBackAcknowledgement()
	 */
	public function setChargeBackAcknowledgement($chargeBackAcknowledgement)
	{
		$this->_chargeBackAcknowledgement = $chargeBackAcknowledgement;
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
		return $this->_serializeOptionalValue('PrimaryLangId', $this->getPrimaryLangId())
			. $this->_serializeNode('OrderId', $this->getOrderId())
			. $this->_serializeNode('StoreId', $this->getStoreId())
			. $this->_serializeOptionalValue('ActionTakenAcknowledgement', $this->getActionTakenAcknowledgement())
			. $this->_serializeOptionalValue('ChargeBackAcknowledgement', $this->getChargeBackAcknowledgement());
	}
}
