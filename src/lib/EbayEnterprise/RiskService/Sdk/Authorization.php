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

class EbayEnterprise_RiskService_Sdk_Authorization
	extends EbayEnterprise_RiskService_Sdk_Payload
	implements EbayEnterprise_RiskService_Sdk_IAuthorization
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
	 * @see EbayEnterprise_RiskService_Sdk_IAuthorization::getDecline()
	 */
	public function getDecline()
	{
		return $this->_decline;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IAuthorization::setDecline()
	 */
	public function setDecline($decline)
	{
		$this->_decline = $decline;
		return $this;
	}

        /**
     	* @see EbayEnterprise_RiskService_Sdk_IAuthorization::getCode()
     	*/
    	public function getCode()
    	{
    	    return $this->_code;
    	}

    	/**
    	 * @see EbayEnterprise_RiskService_Sdk_Server_IAuthorization::setCode()
    	 */
    	public function setCode($code)
    	{
    	    $this->_code = $code;
    	    return $this;
    	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::setHttpHeaders()
	 */
	protected function _canSerialize()
	{
		return (trim($this->getDecline()) !== ''|| trim($this->getCode()) !== '');
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
		return $this->_serializeNode('Decline', $this->getDecline())
			. $this->_serializeOptionalValue('Code', $this->getCode());
	}
}
