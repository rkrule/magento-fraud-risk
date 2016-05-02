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

class EbayEnterprise_RiskService_Sdk_Response
	extends EbayEnterprise_RiskService_Sdk_Response_Abstract
	implements EbayEnterprise_RiskService_Sdk_IResponse
{
	/** @var string */
	protected $_responseReasonCode;
	/** @var string */
	protected $_responseReasonCodeDescription;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setPrimaryLangId' => 'string(x:PrimaryLangId)',
			'setResponseReasonCode' => 'string(x:ResponseReasonCode)',
		);
		$this->_optionalExtractionPaths = array(
			'setOrderId' => 'x:OrderId',
			'setStoreId' => 'x:StoreId',
			'setResponseReasonCodeDescription' => 'x:ResponseReasonCodeDescription',
		);
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IResponse::getResponseReasonCode()
	 */
	public function getResponseReasonCode()
	{
		return $this->_responseReasonCode;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IResponse::setResponseReasonCode()
	 */
	public function setResponseReasonCode($responseReasonCode)
	{
		$this->_responseReasonCode = $responseReasonCode;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IResponse::getResponseReasonCodeDescription()
	 */
	public function getResponseReasonCodeDescription()
	{
		return $this->_responseReasonCodeDescription;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IResponse::setResponseReasonCodeDescription()
	 */
	public function setResponseReasonCodeDescription($responseReasonCodeDescription)
	{
		$this->_responseReasonCodeDescription = $responseReasonCodeDescription;
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
		return $this->_serializeNode('PrimaryLangId', $this->getPrimaryLangId())
			. $this->_serializeOptionalValue('OrderId', $this->getOrderId())
			. $this->_serializeOptionalValue('StoreId', $this->getStoreId())
			. $this->_serializeNode('ResponseReasonCode', $this->getResponseReasonCode())
			. $this->_serializeOptionalValue('ResponseReasonCodeDescription', $this->getResponseReasonCodeDescription());
	}
}
