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

class Radial_RiskService_Sdk_Device_Info
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_Device_IInfo
{
	/** @var string */
	protected $_deviceIP;
	/** @var string */
	protected $_jscData;
	/** @var string */
	protected $_sessionId;
	/** @var string */
	protected $_deviceHostname;
	/** @var string */
	protected $_userCookie;
	/** @var Radial_RiskService_Sdk_Http_Headers */
	protected $_httpHeaders;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setHttpHeaders($this->_buildPayloadForModel(static::HTTP_HEADERS_MODEL));
		$this->_optionalExtractionPaths = array(
			'setJSCData'        =>  'x:JSCData',
			'setSessionID'      =>  'x:SessionID',
			'setDeviceIP'       =>  'x:DeviceIP',
			'setDeviceHostname' =>  'x:DeviceHostname',
			'setUserCookie'	    =>  'x:UserCookie',			
		);
		$this->_subpayloadExtractionPaths = array(
			'setHttpHeaders' => 'x:HttpHeaders',
		);
	}

	/**
         * xsd restrictions: <= 1500 characters
         * @return string
         */
        public function getJSCData()
	{
		return $this->_jscData;
	}

        /**
         * @param   string
         * @return  self
         */
        public function setJSCData($jscData)
	{
		$this->_jscData = $jscData;
		return $this;
	}

	/**
         * xsd restrictions: <= 255 characters
         * @return string
         */
        public function getSessionID()
	{
		return $this->_sessionId;
	}

        /**
         * @param   string
         * @return  self
         */
        public function setSessionID($sessionID)
	{
		$this->_sessionId = $sessionID;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Device_IInfo::getDeviceIP()
	 */
	public function getDeviceIP()
	{
		return $this->_deviceIP;
	}

	/**
	 * @see Radial_RiskService_Sdk_Device_IInfo::setDeviceIP()
	 */
	public function setDeviceIP($deviceIP)
	{
		$this->_deviceIP = $deviceIP;
		return $this;
	}

	/**
         * xsd restrictions: <= 100 characters
         * @return string
         */
        public function getDeviceHostname()
	{
		return $this->_deviceHostname;
	}

        /**
         * @param  string
         * @return self
         */
        public function setDeviceHostname($deviceHostname)
	{
		$this->_deviceHostname = $deviceHostname;
		return $this;
	}

        /**
         * @return string
         */
        public function getUserCookie()
	{
		return $this->_userCookie;
	}

        /**
         * @param  string
         * @return self
         */
        public function setUserCookie($userCookie)
	{
		$this->_userCookie = $userCookie;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Device_IInfo::getHttpHeaders()
	 */
	public function getHttpHeaders()
	{
		return $this->_httpHeaders;
	}

	/**
	 * @see Radial_RiskService_Sdk_Device_IInfo::setHttpHeaders()
	 */
	public function setHttpHeaders(Radial_RiskService_Sdk_Http_Headers $httpHeaders)
	{
		$this->_httpHeaders = $httpHeaders;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::setHttpHeaders()
	 */
	protected function _canSerialize()
	{
		return (trim($this->getDeviceIP()) !== ''|| trim($this->getHttpHeaders()->serialize()) !== '');
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
		return $this->_serializeOptionalValue('JSCData', $this->getJSCData())
			. $this->_serializeOptionalValue('SessionID', $this->getSessionID())
			. $this->_serializeOptionalValue('DeviceIP', $this->getDeviceIP())
			. $this->_serializeOptionalValue('DeviceHostname', $this->getDeviceHostname())
			. $this->getHttpHeaders()->serialize()
			. $this->_serializeOptionalValue('UserCookie', $this->getUserCookie());
	}
}

