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

class EbayEnterprise_RiskService_Sdk_Feedback_Response
	extends EbayEnterprise_RiskService_Sdk_Payload_Top
	implements EbayEnterprise_RiskService_Sdk_Feedback_IResponse
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
	 * @see EbayEnterprise_RiskService_Sdk_Feedback_IResponse::getPrimaryLangId()
	 */
	public function getPrimaryLangId()
	{
		return $this->_primaryLangId;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Feedback_IResponse::setPrimaryLangId()
	 */
	public function setPrimaryLangId($primaryLangId)
	{
		$this->_primaryLangId = $primaryLangId;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Feedback_IResponse::getOrderId()
	 */
	public function getOrderId()
	{
		return $this->_orderId;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Feedback_IResponse::setOrderId()
	 */
	public function setOrderId($orderId)
	{
		$this->_orderId = $orderId;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Feedback_IResponse::getStoreId()
	 */
	public function getStoreId()
	{
		return $this->_storeId;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Feedback_IResponse::setStoreId()
	 */
	public function setStoreId($storeId)
	{
		$this->_storeId = $storeId;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Feedback_IResponse::getActionTakenAcknowledgement()
	 */
	public function getActionTakenAcknowledgement()
	{
		return $this->_actionTakenAcknowledgement;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Feedback_IResponse::setActionTakenAcknowledgement()
	 */
	public function setActionTakenAcknowledgement($actionTakenAcknowledgement)
	{
		$this->_actionTakenAcknowledgement = $actionTakenAcknowledgement;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Feedback_IResponse::getChargeBackAcknowledgement()
	 */
	public function getChargeBackAcknowledgement()
	{
		return $this->_chargeBackAcknowledgement;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Feedback_IResponse::setChargeBackAcknowledgement()
	 */
	public function setChargeBackAcknowledgement($chargeBackAcknowledgement)
	{
		$this->_chargeBackAcknowledgement = $chargeBackAcknowledgement;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload_Top::_getSchemaFile()
	 */
	protected function _getSchemaFile()
	{
		return $this->_getSchemaDir() . self::XSD;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_getXmlNamespace()
	 */
	protected function _getXmlNamespace()
	{
		return static::XML_NS;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_getRootNodeName()
	 */
	protected function _getRootNodeName()
	{
		return static::ROOT_NODE;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_serializeContents()
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
