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

class Radial_RiskService_Sdk_Telephone
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_ITelephone
{
	/** @var string */
	protected $_countryCode;
	/** @var string */
	protected $_areaCode;
	/** @var string */
	protected $_number;
	/** @var string */
	protected $_extension;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setNumber' => 'string(x:Number)',
		);
		$this->_optionalExtractionPaths = array(
			'setCountryCode' => 'x:CountryCode',
			'setAreaCode' => 'x:AreaCode',
			'setExtension' => 'x:Extension',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_ITelephone::getCountryCode()
	 */
	public function getCountryCode()
	{
		return $this->_countryCode;
	}

	/**
	 * @see Radial_RiskService_Sdk_ITelephone::setCountryCode()
	 */
	public function setCountryCode($countryCode)
	{
		$this->_countryCode = $countryCode;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_ITelephone::getAreaCode()
	 */
	public function getAreaCode()
	{
		return $this->_areaCode;
	}

	/**
	 * @see Radial_RiskService_Sdk_ITelephone::setAreaCode()
	 */
	public function setAreaCode($areaCode)
	{
		$this->_areaCode = $areaCode;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_ITelephone::getNumber()
	 */
	public function getNumber()
	{
		return $this->_number;
	}

	/**
	 * @see Radial_RiskService_Sdk_ITelephone::setNumber()
	 */
	public function setNumber($number)
	{
		$this->_number = $number;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_ITelephone::getExtension()
	 */
	public function getExtension()
	{
		return $this->_extension;
	}

	/**
	 * @see Radial_RiskService_Sdk_ITelephone::setExtension()
	 */
	public function setExtension($extension)
	{
		$this->_extension = $extension;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_canSerialize()
	 */
	protected function _canSerialize()
	{
		return (trim($this->getNumber()) !== '');
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
		return $this->_serializeOptionalValue('CountryCode', $this->getCountryCode())
			. $this->_serializeOptionalValue('AreaCode', $this->getAreaCode())
			. $this->_serializeNode('Number', $this->getNumber())
			. $this->_serializeOptionalValue('Extension', $this->getExtension());
	}
}
