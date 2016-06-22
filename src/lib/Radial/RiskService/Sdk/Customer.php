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

/**
 * @codeCoverageIgnore
 */
class Radial_RiskService_Sdk_Customer
    extends Radial_RiskService_Sdk_Info
    implements Radial_RiskService_Sdk_ICustomer
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
	    'setMemberLoggedIn' => 'string(x:MemberLoggedIn)',
        );
        $this->_optionalExtractionPaths = array (
            'setEmail' => 'x:Email',
        );
    	$this->_subpayloadExtractionPaths = array(
	    'setPersonName' => 'x:PersonName',
	    'setTelephone' => 'x:Telephone',
	    'setAddress' => 'x:Address',
	);
    }

    /**
     * @see Radial_RiskService_Sdk_ICustomer::getEmail()
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @see Radial_RiskService_Sdk_ICustomer::setEmail()
     */
    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    /**
     * @see Radial_RiskService_Sdk_ICustomer::getMemberLoggedIn()
     */
    public function getMemberLoggedIn()
    {
        return $this->_memberLoggedIn;
    }

    /**
     * @see Radial_RiskService_Sdk_ICustomer::setMemberLoggedIn()
     */
    public function setMemberLoggedIn($memberLoggedIn)
    {
        $this->_memberLoggedIn = $memberLoggedIn;
        return $this;
    }

    /**
     * @see Radial_RiskService_Sdk_ICustomer::getCurrencyCode()
     */
    public function getCurrencyCode()
    {
        return $this->_currencyCode;
    }

    /**
     * @see Radial_RiskService_Sdk_ICustomer::setCurrencyCode()
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->_currencyCode = $currencyCode;
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
        return $this->getPersonName()->serialize() 
	       . $this->_serializeOptionalValue('Email', $this->getEmail())
	       . $this->getTelephone()->serialize()
	       . $this->getAddress()->serialize()
               . $this->_serializeBooleanNode('MemberLoggedIn', $this->getMemberLoggedIn())
               . $this->_serializeNode('CurrencyCode', $this->getCurrencyCode());
    }
}
