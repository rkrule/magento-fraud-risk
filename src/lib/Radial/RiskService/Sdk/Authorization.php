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

class Radial_RiskService_Sdk_Authorization
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_IAuthorization
{
	/** @var boolean */
	protected $_decline;
	/** @var Integer */
    	protected $_code;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_optionalExtractionPaths = array(
			'setCode' =>	 'x:Code',
		);
        	$this->_extractionPaths = array (
            		'setDecline' => 'boolean(x:Decline)',
        	);
	}

	/**
	 * @see Radial_RiskService_Sdk_IAuthorization::getDecline()
	 */
	public function getDecline()
	{
		return $this->_decline;
	}

	/**
	 * @see Radial_RiskService_Sdk_IAuthorization::setDecline()
	 */
	public function setDecline($decline)
	{
		$this->_decline = $decline;
		return $this;
	}

        /**
     	* @see Radial_RiskService_Sdk_IAuthorization::getCode()
     	*/
    	public function getCode()
    	{
    	    return $this->_code;
    	}

    	/**
    	 * @see Radial_RiskService_Sdk_Server_IAuthorization::setCode()
    	 */
    	public function setCode($code)
    	{
    	    $this->_code = $code;
    	    return $this;
    	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::setHttpHeaders()
	 */
	protected function _canSerialize()
	{
		return (trim($this->getDecline()) !== ''|| trim($this->getCode()) !== '');
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
		return $this->_serializeBooleanNode('Decline', $this->getDecline())
			. $this->_serializeOptionalValue('Code', $this->getCode());
	}
}
