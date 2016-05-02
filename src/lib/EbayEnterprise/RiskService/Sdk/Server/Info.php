
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
	extends EbayEnterprise_RiskService_Sdk_Iterable
	implements EbayEnterprise_RiskService_Sdk_Server_IInfo
{
        /** @var data time */
        protected $_time;
	/** @var string */
	protected $_tzOffset;
	/** @var string */
	protected $_tzOffsetRaw;
	/** @var string */
	protected $_dstActive;

        public function __construct(array $initParams=array())
        {
                parent::__construct($initParams);
                $this->_optionalExtractionPaths = array(
                        'setTZOffset'    =>  'x:TZOffset',
                        'setTZOffsetRaw' =>  'x:TZOffsetRaw',
                	'setDSTActive'	 =>  'x:DSTActive',
		);
		$this->_dateTimeExtractionPaths = array(
                	'setTime'        =>  'x:Time',
		);
        }

	/**
         * @return EbayEnterprise_RiskService_Sdk_Server_IInfo
         */
        public function getTime()
	{
		return $this->_time;
	}

        /**
         * @param  EbayEnterprise_RiskService_Sdk_Server_IInfo
         * @return self
         */
        public function setTime(EbayEnterprise_RiskService_Sdk_Server_IInfo $time)
	{
		$this->_time = $time;
		return $this;
	}

	/**
         * @return EbayEnterprise_RiskService_Sdk_Server_IInfo
         */
        public function getTZOffset()
	{
		return $this->_tzOffset;
	}

        /**
         * @param  EbayEnterprise_RiskService_Sdk_Server_IInfo
         * @return self
         */
        public function setTZOffset(EbayEnterprise_RiskService_Sdk_Server_IInfo $tzOffset)
	{
		$this->_tzOffset = $tzOffset;
		return $this;
	}

	/**
         * @return EbayEnterprise_RiskService_Sdk_Server_IInfo
         */
        public function getTZOffsetRaw()
	{
		return $this->_tzOffsetRaw;
	}

        /**
         * @param  EbayEnterprise_RiskService_Sdk_Server_IInfo
         * @return self
         */
        public function setTZOffsetRaw(EbayEnterprise_RiskService_Sdk_Server_IInfo $tzOffsetRaw)
	{
		$this->_tzOffsetRaw = $tzOffsetRaw;
		return $this;
	}

	/**
         * @return EbayEnterprise_RiskService_Sdk_Server_IInfo
         */
        public function getDSTActive()
	{
		return $this->_dstActive;
	}

        /**
         * @param  EbayEnterprise_RiskService_Sdk_Server_IInfo
         * @return self
         */
        public function setDSTActive(EbayEnterprise_RiskService_Sdk_Server_IInfo $dstActive)
	{
		$this->_dstActive = $dstActive;
		return $this;
	}

	/**
         * @see EbayEnterprise_RiskService_Sdk_Payload:_canSerialize()
         */
        protected function _canSerialize()
        {
                return (trim($this->getTZOffset()) !== ''|| trim($this->getTZOffsetRaw()) !== '' || trim($this->getDSTActive()) !== '');
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
                return $this->_serializeOptionalValue('TZOffset', $this->getTZOffset())
			. $this->_serializeOptionalValue('TZOffsetRaw', $this->getTZOffsetRaw())
			. $this->_serializeOptionalValue('DSTActive', $this->getDSTActive())
                        . $this->_serializeOptionalDateValue('Time', $this->getTime());
        }
}
