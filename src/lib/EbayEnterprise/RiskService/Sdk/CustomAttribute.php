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

class EbayEnterprise_RiskService_Sdk_CustomAttribute
	extends EbayEnterprise_RiskService_Sdk_Payload
	implements EbayEnterprise_RiskService_Sdk_CustomAttribute
{
	/** @var string **/
	protected $_attributeName;
	/** @var string **/
	protected $_attributeValue;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setAttributeName' => 'x:AttributeName',
			'setAttributeValue' => 'x:AttributeValue',
		);
	}

	/**
         * @see EbayEnterprise_RiskService_Sdk_ICustomAttribute::getAttributeName()
         */
        public function getAttributeName()
        {
                return $this->_attributeName;
        }

	/**
	 * @see EbayEnterprise_RiskService_Sdk_ICustomAttribute::setAttributeName()
	 */
	public function setAttributeName($attributeName)
	{
		$this->_attributeName = $attributeName;
		return $this;
	}

	/**
         * @see EbayEnterprise_RiskService_Sdk_ICustomAttribute::getAttributeValue()
         */
        public function getAttributeValue()
        {
                return $this->_attributeValue;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_ICustomAttribute::setAttributeValue()
         */
        public function setAttributeValue($attributeValue)
        {
                $this->_attributeValue = $attributeValue;
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
		return $this->_serializeNode('AttributeName', $this->getAttributeName())
			. $this->_serializeNode('AttributeValue', $this->getAttributeValue());
	}
}
