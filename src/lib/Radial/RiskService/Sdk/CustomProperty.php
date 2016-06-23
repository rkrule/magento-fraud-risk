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

class Radial_RiskService_Sdk_CustomProperty
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_ICustomProperty
{
	/** @var string **/
	protected $_name;
	/** @var strubg **/
	protected $_stringValue;

	public function __construct(array $initParams=array())
        {
        	parent::__construct($initParams);
		
        	$this->_extractionPaths = array(
        	    'setName' => 'string(@Name)',
		    'setStringValue' => 'string(x:StringValue)',
        	);
    	}

	/**
	 * @see Radial_RiskService_Sdk_Iterable::_getRootNodeName()
	 */
	protected function _getRootNodeName()
	{
		return static::ROOT_NODE;
	}

	/**
	 * @see Radial_RiskService_Sdk_Iterable::_getXmlNamespace()
	 */
	protected function _getXmlNamespace()
	{
		return self::XML_NS;
	}

	/**
	 * @return  string 
	 */
	public function getName()
	{
		return $this->_name;
	}

	/**
	 * @param  string
	 * @return self
	 */
	public function setName($name)
	{
		$this->_name = $name;
		return $this;
	}

	/**
         * @return  string
         */
        public function getStringValue()
        {
                return $this->_stringValue;
        }

        /**
         * @param  string
         * @return self
         */
        public function setStringValue($value)
        {
                $this->_stringValue = $value;
                return $this;
        }

	 /**
         * @see Radial_RiskService_Sdk_Payload::_getRootAttributes()
         */
        protected function _getRootAttributes()
        {
                return array(
                        'Name' => $this->getName(),
                );
        }

       /**
     	* @see Radial_RiskService_Sdk_Payload::_serializeContents()
     	*/
        protected function _serializeContents()
    	{
        	       return $this->_serializeNode('StringValue', $this->getStringValue());
    	}
}
