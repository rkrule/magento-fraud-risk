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

class Radial_RiskService_Sdk_CustomPropertyGroup
	extends Radial_RiskService_Sdk_Iterable
	implements Radial_RiskService_Sdk_ICustomPropertyGroup
{
        /**
         * Get an empty instance of the custom property group payload
         *
         * @return Radial_RiskService_Sdk_CustomPropertyGroup
         */
        public function getEmptyCustomProperty()
        {
                return $this->_buildPayloadForModel(static::CUSTOM_PROPERTY_MODEL);
        }

        /**
         * @see Radial_RiskService_Sdk_Iterable::_getNewSubpayload()
         */
        protected function _getNewSubpayload()
        {
                return $this->getEmptyCustomProperty();
        }

        /**
         * @see Radial_RiskService_Sdk_Iterable::_getSubpayloadXPath()
         */
        protected function _getSubpayloadXPath()
        {
                return 'x:' . static::SUBPAYLOAD_XPATH;
        }


	/** @var string **/
	protected $_name;

	public function __construct(array $initParams=array())
        {
        	parent::__construct($initParams);
		
        	$this->_extractionPaths = array(
        	    'setName' => 'string(@Name)',
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
         * @see Radial_RiskService_Sdk_Payload::_getRootAttributes()
         */
        protected function _getRootAttributes()
        {
                return array(
                        'Name' => $this->getName(),
                );
        }
}
