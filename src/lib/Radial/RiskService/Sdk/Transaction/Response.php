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

class Radial_RiskService_Sdk_Transaction_Response
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_Transaction_IResponse
{
	/** @var string */
	protected $_response;
	/** @var string */
	protected $_responseType;
	/** @var array */
	protected $_responseTypeEnums = array(
		'avsAddr',
		'avsZip',
		'3ds',
		'cvv2',
		'PayPalPayer',
		'PayPalAddress',
		'PayPalPayerCountry',
		'PayPalSellerProtection',
		'AmexName',
		'AmexEmail',
		'AmexPhone'
	);
	/** @var array */
	protected $_responseEnums = array('M', 'N', 'confirmed', 'verified', 'X');

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setResponse' => 'string(.)',
			'setResponseType' => 'string(@ResponseType)',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_Transaction_IResponse::getResponse()
	 */
	public function getResponse()
	{
		return $this->_response;
	}

	/**
	 * @see Radial_RiskService_Sdk_Transaction_IResponse::setResponse()
	 */
	public function setResponse($response)
	{
		$this->_response = $response;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Transaction_IResponse::getResponseType()
	 */
	public function getResponseType()
	{
		return $this->_responseType;
	}

	/**
	 * @see Radial_RiskService_Sdk_Transaction_IResponse::setResponseType()
	 */
	public function setResponseType($responseType)
	{
		$this->_responseType = $responseType;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_canSerialize()
	 */
	protected function _canSerialize()
	{
		return in_array($this->getResponse(), $this->_responseEnums)
			&& in_array($this->getResponseType(), $this->_responseTypeEnums);
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
		return $this->getResponse();
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getRootAttributes()
	 */
	protected function _getRootAttributes()
	{
		return array(
			'ResponseType' => $this->getResponseType(),
		);
	}
}
