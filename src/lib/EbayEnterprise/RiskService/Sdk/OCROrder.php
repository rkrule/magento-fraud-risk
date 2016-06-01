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

class EbayEnterprise_RiskService_Sdk_OCROrder
	extends EbayEnterprise_RiskService_Sdk_Payload
	implements EbayEnterprise_RiskService_Sdk_IOCROrder
{
	/** @var string **/
	protected $_orderId;
	/** @var string **/
	protected $_storeId;
	/** @var string **/
	protected $_statusDate;
	/** @var string **/
	protected $_confirmationType;
	/** @var string **/
	protected $_orderStatus;
	/** @var string **/
	protected $_orderStatusReason;
	/** @var EbayEnterprise_RiskService_Sdk_Line_IDetails **/
	protected $_lineDetails;
	/** @var EbayEnterprise_RiskService_Sdk_ICustomAttributesList **/
	protected $_customAttributesList;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setLineDetails($this->_buildPayloadForModel(static::LINE_DETAILS_MODEL));
        	$this->setCustomAttributesList($this->_buildPayloadForModel(static::CUSTOM_ATTRIBUTES_LIST_MODEL));
		$this->_subpayloadExtractionPaths = array(
			'setLineDetails' => 'x:LineDetails',
            		'setCustomAttributesList' => 'x:CustomAttributesList',
		);
		$this->_extractionPaths = array(
			'setOrderId' => 'string(x:OrderId)',
			'setStoreId' => 'string(x:StoreId)',
			'setConfirmationType' => 'string(x:ConfirmationType)',
		);
		$this->_optionalExtractionPaths = array(
			'setOrderStatus' => 'string(x:OrderStatus)',
			'setOrderStatusReason' => 'string(x:OrderStatusReason)',
		);
		$this->_dateTimeExtractionPaths = array(
                        'setStatusDate' => 'string(x:StatusDate)', 
                );
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::getOrderId()
	 */
	public function getOrderId()
	{
		return $this->_orderId;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::setOrderId()
	 */
	public function setOrderId($orderId)
	{
		$this->_orderId = $orderId;
		return $this;
	}

    	/**
     	 * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::getStoreId()
     	 */
    	public function getStoreId()
    	{
        	return $this->_storeId;
    	}

    	/**
     	 * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::setStoreId()
     	 */
    	public function setStoreId($storeId)
    	{
        	$this->_storeId = $storeId;
        	return $this;
    	}

    	/**
     	 * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::getStatusDate()
     	 */
    	public function getStatusDate()
    	{
        	return $this->_statusDate;
    	}

    	/**
     	 * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::setStatusDate()
     	 */
    	public function setStatusDate(DateTime $statusDate)
    	{
        	$this->_statusDate = $statusDate;
        	return $this;
    	}

	/**
         * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::getConfirmationType()
         */
        public function getConfirmationType()
        {
                return $this->_confirmationType;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::setConfirmationType()
         */
        public function setConfirmationType($confirmationType)
        {
                $this->_confirmationType = $confirmationType;
                return $this;
        }

	/**
         * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::getOrderStatus()
         */
        public function getOrderStatus()
        {
                return $this->_orderStatus;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::setOrderStatus()
         */
        public function setOrderStatus($orderStatus)
        {
                $this->_orderStatus = $orderStatus;
                return $this;
        }

	/**
         * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::getOrderStatusReason()
         */
        public function getOrderStatusReason()
        {
                return $this->_orderStatusReason;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::setOrderStatusReason()
         */
        public function setOrderStatusReason($orderStatusReason)
        {
                $this->_orderStatusReason = $orderStatusReason;
                return $this;
        }

	/**
         * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::getLineDetails()
         */
        public function getLineDetails()
        {
                return $this->_lineDetails;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::setLineDetails()
         */
        public function setLineDetails(EbayEnterprise_RiskService_Sdk_Line_IDetails $lineDetails)
        {
                $this->_lineDetails = $lineDetails;
                return $this;
        }

	/**
         * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::getCustomAttributesList()
         */
        public function getCustomAttributesList()
        {
                return $this->_customAttributesList;
        }
                
        /**
         * @see EbayEnterprise_RiskService_Sdk_IOrderConfirmationRequest::setCustomAttributesList()
         */
        public function setCustomAttributesList(EbayEnterprise_RiskService_Sdk_CustomAttributes_IList $customAttributesList)
        {
                $this->_customAttributesList = $customAttributesList;
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
		return $this->_serializeNode('OrderId', $this->getOrderId())
                        . $this->_serializeNode('StoreId', $this->getStoreId())
			. $this->_serializeOptionalDateValue('StatusDate', 'c', $this->getStatusDate())
			. $this->_serializeNode('ConfirmationType', $this->getConfirmationType())
			. $this->_serializeOptionalValue('OrderStatus', $this->getOrderStatus())
			. $this->_serializeOptionalValue('OrderStatusReason', $this->getOrderStatusReason())
			. $this->getLineDetails()->serialize()
			. $this->getCustomAttributesList()->serialize();
	}
}
