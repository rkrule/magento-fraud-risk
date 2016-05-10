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

class EbayEnterprise_RiskService_Sdk_Request
	extends EbayEnterprise_RiskService_Sdk_Payload_Top
	implements EbayEnterprise_RiskService_Sdk_IRequest
{
	/** @var EbayEnterprise_RiskService_Sdk_IOrder */
	protected $_order;
    /** @var EbayEnterprise_RiskService_Sdk_Server_Info */
    protected $_serverInfo;
    /** @var EbayEnterprise_RiskService_Sdk_Device_Info */
    protected $_deviceInfo;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setOrder($this->_buildPayloadForModel(static::ORDER_MODEL));
        $this->setServerInfo($this->_buildPayloadForModel(static::SERVER_INFO_MODEL));
        $this->setDeviceInfo($this->_buildPayloadForModel(static::DEVICE_INFO_MODEL));
		$this->_subpayloadExtractionPaths = array(
			'setOrder' => 'x:Order',
            'setServerInfo' => 'x:ServerInfo',
            'setDeviceInfo' => 'x:DeviceInfo',
		);
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IRequest::getOrder()
	 */
	public function getOrder()
	{
		return $this->_order;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IRequest::setOrder()
	 */
	public function setOrder(EbayEnterprise_RiskService_Sdk_IOrder $order)
	{
		$this->_order = $order;
		return $this;
	}

    /**
     * @see EbayEnterprise_RiskService_Sdk_IOrder::getServerInfo()
     */
    public function getServerInfo()
    {
        return $this->_serverInfo;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_IOrder::setServerInfo()
     */
    public function setServerInfo(EbayEnterprise_RiskService_Sdk_Server_IInfo $serverInfo)
    {
        $this->_serverInfo = $serverInfo;
        return $this;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_IOrder::getDeviceInfo()
     */
    public function getDeviceInfo()
    {
        return $this->_deviceInfo;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_IOrder::setDeviceInfo()
     */
    public function setDeviceInfo(EbayEnterprise_RiskService_Sdk_Device_IInfo $deviceInfo)
    {
        $this->_deviceInfo = $deviceInfo;
        return $this;
    }

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload_Top::_getSchemaFile()
	 */
	protected function _getSchemaFile()
	{
		return $this->_getSchemaDir() . self::XSD;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_getXmlNamespace()
	 */
	protected function _getXmlNamespace()
	{
		return static::XML_NS;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_getRootNodeName()
	 */
	protected function _getRootNodeName()
	{
		return static::ROOT_NODE;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_serializeContents()
	 */
	protected function _serializeContents()
	{
		return $this->getOrder()->serialize()
			. $this->getServerInfo()->serialize()
            . $this->getDeviceInfo()->serialize();
	}
}
