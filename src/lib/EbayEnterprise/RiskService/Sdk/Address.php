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

class EbayEnterprise_RiskService_Sdk_Address
	extends EbayEnterprise_RiskService_Sdk_Payload
	implements EbayEnterprise_RiskService_Sdk_IAddress
{
	/** @var string */
	protected $_lineA;
	/** @var string */
	protected $_lineB;
	/** @var string */
	protected $_lineC;
	/** @var string */
	protected $_lineD;
	/** @var string */
	protected $_city;
	/** @var string */
	protected $_postalCode;
	/** @var string */
	protected $_mainDivision;
	/** @var string */
	protected $_countryCode;
	/** @var string */
	protected $_addressID;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setLineA' => 'string(x:Line1)',
			'setPostalCode' => 'string(x:PostalCode)',
			'setCountryCode' => 'string(x:CountryCode)',
			'setAddressID'  => 'string(@AddressId)',
		);
		$this->_optionalExtractionPaths = array(
			'setLineB' => 'x:Line2',
			'setLineC' => 'x:Line3',
			'setLineD' => 'x:Line4',
			'setCity' => 'x:City',
			'setMainDivision' => 'x:MainDivision',
		);
	}

	/**
         * @see EbayEnterprise_RiskService_Sdk_IAddress::getAddressID()
         */
        public function getAddressID()
        {
                return $this->_addressID;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IAddress::setAddressID()
         */
        public function setAddressID($addressID)
        {
                $this->_addressID = $addressID;
                return $this;
        }


	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::getLineA()
	 */
	public function getLineA()
	{
		return $this->_lineA;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::setLineA()
	 */
	public function setLineA($lineA)
	{
		$this->_lineA = $lineA;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::getLineB()
	 */
	public function getLineB()
	{
		return $this->_lineB;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::setLineB()
	 */
	public function setLineB($lineB)
	{
		$this->_lineB = $lineB;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::getLineC()
	 */
	public function getLineC()
	{
		return $this->_lineC;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::setLineC()
	 */
	public function setLineC($lineC)
	{
		$this->_lineC = $lineC;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::getLineD()
	 */
	public function getLineD()
	{
		return $this->_lineD;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::setLineD()
	 */
	public function setLineD($lineD)
	{
		$this->_lineD = $lineD;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::getCity()
	 */
	public function getCity()
	{
		return $this->_city;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::setCity()
	 */
	public function setCity($city)
	{
		$this->_city = $city;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::getPostalCode()
	 */
	public function getPostalCode()
	{
		return $this->_postalCode;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::setPostalCode()
	 */
	public function setPostalCode($postalCode)
	{
		$this->_postalCode = $postalCode;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::getMainDivision()
	 */
	public function getMainDivision()
	{
		return $this->_mainDivision;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::setMainDivision()
	 */
	public function setMainDivision($mainDivision)
	{
		$this->_mainDivision = $mainDivision;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::getCountryCode()
	 */
	public function getCountryCode()
	{
		return $this->_countryCode;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAddress::setCountryCode()
	 */
	public function setCountryCode($countryCode)
	{
		$this->_countryCode = $countryCode;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_canSerialize()
	 */
	protected function _canSerialize()
	{
		return (
			trim($this->getLineA()) !== ''
			&& trim($this->getPostalCode()) !== ''
			&& trim($this->getCountryCode()) !== ''
		);
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
		return $this->_serializeNode('Line1', $this->getLineA())
			. $this->_serializeOptionalValue('Line2', $this->getLineB())
			. $this->_serializeOptionalValue('Line3', $this->getLineC())
			. $this->_serializeOptionalValue('Line4', $this->getLineD())
			. $this->_serializeOptionalValue('City', $this->getCity())
			. $this->_serializeOptionalValue('MainDivision', $this->getMainDivision())
			. $this->_serializeNode('CountryCode', $this->getCountryCode())
			. $this->_serializeNode('PostalCode', $this->getPostalCode());
	}

        /**
         * @see EbayEnterprise_RiskService_Sdk_Payload::_getRootAttributes()
         */
        protected function _getRootAttributes()
        {
                return array(
                        'AddressId'  => $this->getAddressID(),
                );
        }
}
