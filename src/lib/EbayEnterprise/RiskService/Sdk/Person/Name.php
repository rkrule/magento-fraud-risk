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

class EbayEnterprise_RiskService_Sdk_Person_Name
	extends EbayEnterprise_RiskService_Sdk_Payload
	implements EbayEnterprise_RiskService_Sdk_Person_IName
{
	/** @var string */
	protected $_lastName;
	/** @var string */
	protected $_middleName;
	/** @var string */
	protected $_firstName;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setFirstName' => 'string(x:FirstName)',
		);
		$this->_optionalExtractionPaths = array(
			'setLastName' => 'x:LastName',
			'setMiddleName' => 'x:MiddleName',
		);
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Person_IName::getLastName()
	 */
	public function getLastName()
	{
		return $this->_lastName;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Person_IName::setLastName()
	 */
	public function setLastName($lastName)
	{
		$this->_lastName = $lastName;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Person_IName::getMiddleName()
	 */
	public function getMiddleName()
	{
		return $this->_middleName;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Person_IName::setMiddleName()
	 */
	public function setMiddleName($middleName)
	{
		$this->_middleName = $middleName;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Person_IName::getFirstName()
	 */
	public function getFirstName()
	{
		return $this->_firstName;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Person_IName::setFirstName()
	 */
	public function setFirstName($firstName)
	{
		$this->_firstName = $firstName;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_canSerialize()
	 */
	protected function _canSerialize()
	{
		return (trim($this->getFirstName()) !== '');
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
		return $this->_serializeOptionalValue('LastName', $this->getLastName())
			. $this->_serializeOptionalValue('MiddleName', $this->getMiddleName())
			. $this->_serializeNode('FirstName', $this->getFirstName());
	}
}
