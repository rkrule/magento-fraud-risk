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

class EbayEnterprise_RiskService_Sdk_Telephone
	extends EbayEnterprise_RiskService_Sdk_Payload
	implements EbayEnterprise_RiskService_Sdk_ITelephone
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
	 * @see EbayEnterprise_RiskService_Sdk_ITelephone::getCountryCode()
	 */
	public function getCountryCode()
	{
		return $this->_countryCode;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_ITelephone::setCountryCode()
	 */
	public function setCountryCode($countryCode)
	{
		$this->_countryCode = $countryCode;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_ITelephone::getAreaCode()
	 */
	public function getAreaCode()
	{
		return $this->_areaCode;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_ITelephone::setAreaCode()
	 */
	public function setAreaCode($areaCode)
	{
		$this->_areaCode = $areaCode;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_ITelephone::getNumber()
	 */
	public function getNumber()
	{
		return $this->_number;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_ITelephone::setNumber()
	 */
	public function setNumber($number)
	{
		$this->_number = $number;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_ITelephone::getExtension()
	 */
	public function getExtension()
	{
		return $this->_extension;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_ITelephone::setExtension()
	 */
	public function setExtension($extension)
	{
		$this->_extension = $extension;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_canSerialize()
	 */
	protected function _canSerialize()
	{
		return (trim($this->getNumber()) !== '');
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
		return $this->_serializeOptionalValue('CountryCode', $this->getCountryCode())
			. $this->_serializeOptionalValue('AreaCode', $this->getAreaCode())
			. $this->_serializeNode('Number', $this->getNumber())
			. $this->_serializeOptionalValue('Extension', $this->getExtension());
	}
}
