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

class EbayEnterprise_RiskService_Sdk_Server_Info
	extends EbayEnterprise_RiskService_Sdk_Payload
	implements EbayEnterprise_RiskService_Sdk_Server_IInfo
{
	/** @var DateTime */
	protected $_time;
	/** @var String */
    protected $_tzOffset;
	/** @var String */
	protected $_tzOffsetRaw;
    /** @var Boolean */
    protected $_dstActive;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setTZOffset' => 'number(x:TZOffset)',
			'setDSTActive' => 'boolean(x:DSTActive)',
		);
		$this->_dateTimeExtractionPaths = array(
                        'setTime' => 'string(x:Time)',
                );
		$this->_optionalExtractionPaths = array (
			'setTZOffsetRaw' => 'x:TZOffsetRaw',
		);
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Server_IInfo::getTime()
	 */
	public function getTime()
	{
		return $this->_time;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Server_IInfo::setTime()
	 */
	public function setTime(DateTime $time)
	{
		$this->_time = $time;
		return $this;
	}

    /**
     * @see EbayEnterprise_RiskService_Sdk_Server_IInfo::getTZOffset()
     */
    public function getTZOffset()
    {
        return $this->_tzOffset;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_Server_IInfo::setTZOffset()
     */
    public function setTZOffset($tzOffset)
    {
        $this->_tzOffset = $tzOffset;
        return $this;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_Server_IInfo::getTZOffsetRaw()
     */
    public function getTZOffsetRaw()
    {
        return $this->_tzOffsetRaw;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_Server_IInfo::setTZOffsetRaw()
     */
    public function setTZOffsetRaw($tzOffsetRaw)
    {
        $this->_tzOffsetRaw = $tzOffsetRaw;
        return $this;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_Server_IInfo::getDSTActive()
     */
    public function getDSTActive()
    {
        return $this->_dstActive;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_Server_IInfo::setDSTActive()
     */
    public function setDSTActive($dstActive)
    {
        $this->_dstActive = $dstActive;
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
		return $this->_serializeOptionalDateValue('Time', 'c', $this->getTime()) 
			. $this->_serializeNode('TZOffset', $this->getTZOffset())
	                . $this->_serializeNode('DSTActive', $this->getDSTActive());
	}
}
