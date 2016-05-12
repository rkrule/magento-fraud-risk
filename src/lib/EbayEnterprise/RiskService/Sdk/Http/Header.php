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

class EbayEnterprise_RiskService_Sdk_Http_Header
	extends EbayEnterprise_RiskService_Sdk_Payload
	implements EbayEnterprise_RiskService_Sdk_Http_IHeader
{
	/** @var string */
	protected $_header;
	/** @var string */
	protected $_name;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setHeader' => 'string(.)',
			'setName' => 'string(@name)',
		);
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Http_IHeader::getDeviceIP()
	 */
	public function getHeader()
	{
		return $this->_header;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Http_IHeader::setHeader()
	 */
	public function setHeader($header)
	{
		$this->_header = $header;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Http_IHeader::getName()
	 */
	public function getName()
	{
		return $this->_name;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Http_IHeader::setName()
	 */
	public function setName($name)
	{
		$this->_name = $name;
		return $this;
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
		return $this->getHeader();
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_getRootAttributes()
	 */
	protected function _getRootAttributes()
	{
		return array(
			'name' => $this->getName(),
		);
	}
}
