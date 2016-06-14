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

class Radial_RiskService_Sdk_CustomAttribute
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_ICustomAttribute
{
	/** @var string **/
	protected $_attributeName;
	/** @var string **/
	protected $_attributeValue;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setAttributeName' => 'string(x:AttributeName)',
			'setAttributeValue' => 'string(x:AttributeValue)',
		);
	}

	/**
         * @see Radial_RiskService_Sdk_ICustomAttribute::getAttributeName()
         */
        public function getAttributeName()
        {
                return $this->_attributeName;
        }

	/**
	 * @see Radial_RiskService_Sdk_ICustomAttribute::setAttributeName()
	 */
	public function setAttributeName($attributeName)
	{
		$this->_attributeName = $attributeName;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_ICustomAttribute::getAttributeValue()
         */
        public function getAttributeValue()
        {
                return $this->_attributeValue;
        }

        /**
         * @see Radial_RiskService_Sdk_ICustomAttribute::setAttributeValue()
         */
        public function setAttributeValue($attributeValue)
        {
                $this->_attributeValue = $attributeValue;
                return $this;
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
		return $this->_serializeNode('AttributeName', $this->getAttributeName())
			. $this->_serializeNode('AttributeValue', $this->getAttributeValue());
	}
}
