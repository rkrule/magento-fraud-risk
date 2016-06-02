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

class Radial_RiskService_Sdk_OCResponse
	extends Radial_RiskService_Sdk_Response_Abstract
	implements Radial_RiskService_Sdk_IOCResponse
{
	protected $_createTimestamp;
	protected $_orderConfirmationAcknowledgement;

	/**
         * CreateTimestamp
         *
         * @return string
         */
        public function getCreateTimestamp()
	{
		return $this->_createTimestamp;	
	}

        /**
         * @param  string
         * @return self
         */
        public function setCreateTimestamp(DateTime $createTimestamp)
	{
		$this->_createTimestamp = $createTimestamp;
		return $this;
	}

	/**
         * OrderConfirmationAcknowledgement
         *
         * @return string
         */
        public function getOrderConfirmationAcknowledgement()
	{
		return $this->_orderConfirmationAcknowledgement;
	}

        /**
         * @param  string
         * @return self
         */
        public function setOrderConfirmationAcknowledgement($orderConfirmationAcknowledgement)
	{
		$this->_orderConfirmationAcknowledgement = $orderConfirmationAcknowledgement;
		return $this;
	}

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setOrderId' => 'string(x:OrderId)',
			'setStoreId' => 'string(x:StoreId)',
			'setOrderConfirmationAcknowledgement' => 'string(x:OrderConfirmationAcknowledgement)',
		);
		$this->_dateTimeExtractionPaths = array(
                	'setCreateTimestamp' => 'string(x:CreateTimestamp)',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload_Top::_getSchemaFile()
	 */
	protected function _getSchemaFile()
	{
		return $this->_getSchemaDir() . self::XSD;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getXmlNamespace()
	 */
	protected function _getXmlNamespace()
	{
		return static::XML_NS;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getRootNodeName()
	 */
	protected function _getRootNodeName()
	{
		return static::ROOT_NODE;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_serializeContents()
	 */
	protected function _serializeContents()
	{
		return $this->_serializeNode('OrderId', $this->getOrderId())
			. $this->_serializeNode('StoreId', $this->getStoreId())
			. $this->_serializeOptionalDateValue('CreateTimestamp', 'c', $this->getCreateTimestamp())
			. $this->_serializeNode('OrderConfirmationAcknowledgement', $this->getOrderConfirmationAcknowledgement());
	}
}
