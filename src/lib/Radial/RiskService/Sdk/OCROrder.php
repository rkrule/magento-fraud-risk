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

class Radial_RiskService_Sdk_OCROrder
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_IOCROrder
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
	/** @var Radial_RiskService_Sdk_Line_IDetails **/
	protected $_lineDetails;
	/** @var Radial_RiskService_Sdk_ICustomAttributesList **/
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
			'setOrderStatus' => 'x:OrderStatus',
			'setOrderStatusReason' => 'x:OrderStatusReason',
		);
		$this->_dateTimeExtractionPaths = array(
                        'setStatusDate' => 'string(x:StatusDate)', 
                );
	}

	/**
	 * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::getOrderId()
	 */
	public function getOrderId()
	{
		return $this->_orderId;
	}

	/**
	 * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::setOrderId()
	 */
	public function setOrderId($orderId)
	{
		$this->_orderId = $orderId;
		return $this;
	}

    	/**
     	 * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::getStoreId()
     	 */
    	public function getStoreId()
    	{
        	return $this->_storeId;
    	}

    	/**
     	 * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::setStoreId()
     	 */
    	public function setStoreId($storeId)
    	{
        	$this->_storeId = $storeId;
        	return $this;
    	}

    	/**
     	 * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::getStatusDate()
     	 */
    	public function getStatusDate()
    	{
        	return $this->_statusDate;
    	}

    	/**
     	 * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::setStatusDate()
     	 */
    	public function setStatusDate(DateTime $statusDate)
    	{
        	$this->_statusDate = $statusDate;
        	return $this;
    	}

	/**
         * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::getConfirmationType()
         */
        public function getConfirmationType()
        {
                return $this->_confirmationType;
        }

        /**
         * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::setConfirmationType()
         */
        public function setConfirmationType($confirmationType)
        {
                $this->_confirmationType = $confirmationType;
                return $this;
        }

	/**
         * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::getOrderStatus()
         */
        public function getOrderStatus()
        {
                return $this->_orderStatus;
        }

        /**
         * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::setOrderStatus()
         */
        public function setOrderStatus($orderStatus)
        {
                $this->_orderStatus = $orderStatus;
                return $this;
        }

	/**
         * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::getOrderStatusReason()
         */
        public function getOrderStatusReason()
        {
                return $this->_orderStatusReason;
        }

        /**
         * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::setOrderStatusReason()
         */
        public function setOrderStatusReason($orderStatusReason)
        {
                $this->_orderStatusReason = $orderStatusReason;
                return $this;
        }

	/**
         * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::getLineDetails()
         */
        public function getLineDetails()
        {
                return $this->_lineDetails;
        }

        /**
         * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::setLineDetails()
         */
        public function setLineDetails(Radial_RiskService_Sdk_Line_IDetails $lineDetails)
        {
                $this->_lineDetails = $lineDetails;
                return $this;
        }

	/**
         * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::getCustomAttributesList()
         */
        public function getCustomAttributesList()
        {
                return $this->_customAttributesList;
        }
                
        /**
         * @see Radial_RiskService_Sdk_IOrderConfirmationRequest::setCustomAttributesList()
         */
        public function setCustomAttributesList(Radial_RiskService_Sdk_CustomAttributes_IList $customAttributesList)
        {
                $this->_customAttributesList = $customAttributesList;
                return $this;
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
			. $this->_serializeOptionalDateValue('StatusDate', 'c', $this->getStatusDate())
			. $this->_serializeNode('ConfirmationType', $this->getConfirmationType())
			. $this->_serializeOptionalValue('OrderStatus', $this->getOrderStatus())
			. $this->_serializeOptionalValue('OrderStatusReason', $this->getOrderStatusReason())
			. $this->getLineDetails()->serialize()
			. $this->getCustomAttributesList()->serialize();
	}
}
