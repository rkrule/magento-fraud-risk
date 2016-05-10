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

/**
 * @codeCoverageIgnore
 */
class EbayEnterprise_RiskService_Sdk_Customer
    extends EbayEnterprise_RiskService_Sdk_Info
    implements EbayEnterprise_RiskService_Sdk_ICustomer
{
    /** @var string */
    protected $_email;
    /** var boolean */
    protected $_memberLoggedIn;
    /** var string */
    protected $_currencyCode;

    public function __construct(array $initParams=array())
    {
        parent::__construct($initParams);
        $this->setPersonName($this->_buildPayloadForModel(static::PERSON_NAME_MODEL));
        $this->setTelephone($this->_buildPayloadForModel(static::TELEPHONE_MODEL));
        $this->setAddress($this->_buildPayloadForModel(static::ADDRESS_MODEL));
        $this->_extractionPaths = array(
            'setCurrencyCode' => 'string(x:CurrencyCode)',
        );
        $this->_optionalExtractionPaths = array (
            'setEmail' => 'string(x:PromoCode)',
        );
        $this->_booleanExtractionPaths = array (
            'setMemberLoggedIn' => 'string(x:MemberLoggedIn)',
        );
    	$this->_subpayloadExtractionPaths = array(
	    'setPersonName' => 'x:PersonName',
	    'setTelephone' => 'x:Telephone',
	    'setAddress' => 'x:Address',
	);
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_ICustomer::getEmail()
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_ICustomer::setEmail()
     */
    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_ICustomer::getMemberLoggedIn()
     */
    public function getMemberLoggedIn()
    {
        return $this->_memberLoggedIn;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_ICustomer::setMemberLoggedIn()
     */
    public function setMemberLoggedIn($memberLoggedIn)
    {
        $this->_memberLoggedIn = $memberLoggedIn;
        return $this;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_ICustomer::getCurrencyCode()
     */
    public function getCurrencyCode()
    {
        return $this->_currencyCode;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_ICustomer::setCurrencyCode()
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->_currencyCode = $currencyCode;
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
        return $this->getPersonName()->serialize() 
	       . $this->_serializeOptionalValue('Email', $this->getEmail())
	       . $this->getTelephone()->serialize()
	       . $this->getAddress()->serialize()
               . $this->_serializeNode('MemberLoggedIn', $this->getMemberLoggedIn())
               . $this->_serializeNode('CurrencyCode', $this->getCurrencyCode());
    }
}
