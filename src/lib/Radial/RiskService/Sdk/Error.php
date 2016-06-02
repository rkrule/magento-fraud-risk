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

class Radial_RiskService_Sdk_Error
	extends Radial_RiskService_Sdk_Response_Abstract
	implements Radial_RiskService_Sdk_IError
{
	/** @var string */
	protected $_errorCode;
	/** @var string */
	protected $_errorDescription;
	/** @var string */
	protected $_exceptionLog;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setErrorCode' => 'string(x:ErrorCode)',
			'setErrorDescription' => 'string(x:ErrorDescription)',
		);
		$this->_optionalExtractionPaths = array(
			'setPrimaryLangId' => 'x:PrimaryLangId',
			'setOrderId' => 'x:OrderId',
			'setStoreId' => 'x:StoreId',
			'setExceptionLog' => 'x:ExceptionLog',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_IError::getErrorCode()
	 */
	public function getErrorCode()
	{
		return $this->_errorCode;
	}

	/**
	 * @see Radial_RiskService_Sdk_IError::setErrorCode()
	 */
	public function setErrorCode($errorCode)
	{
		$this->_errorCode = $errorCode;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_IError::getErrorDescription()
	 */
	public function getErrorDescription()
	{
		return $this->_errorDescription;
	}

	/**
	 * @see Radial_RiskService_Sdk_IError::setErrorDescription()
	 */
	public function setErrorDescription($errorDescription)
	{
		$this->_errorDescription = $errorDescription;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_IError::getExceptionLog()
	 */
	public function getExceptionLog()
	{
		return $this->_exceptionLog;
	}

	/**
	 * @see Radial_RiskService_Sdk_IError::setExceptionLog()
	 */
	public function setExceptionLog($exceptionLog)
	{
		$this->_exceptionLog = $exceptionLog;
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
			. $this->_serializeOptionalValue('OrderId', $this->getOrderId())
			. $this->_serializeOptionalValue('StoreId', $this->getStoreId())
			. $this->_serializeNode('ErrorCode', $this->getErrorCode())
			. $this->_serializeNode('ErrorDescription', $this->getErrorDescription())
			. $this->_serializeOptionalValue('ExceptionLog', $this->getExceptionLog());
	}
}
