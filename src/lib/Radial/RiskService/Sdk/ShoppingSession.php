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

class Radial_RiskService_Sdk_ShoppingSession
    extends Radial_RiskService_Sdk_Payload
    implements Radial_RiskService_Sdk_IShoppingSession
{
    /** @var string */
    protected $_timeOnSite;
    /** @var Boolean */
    protected $_returnCustomer;
    /** @var Boolean */
    protected $_itemsRemoved;

    public function __construct(array $initParams=array())
    {
        parent::__construct($initParams);
	$this->_extractionPaths = array(
	    'setTimeOnSite' => 'number(x:TimeOnSite)',
	    'setReturnCustomer' => 'boolean(x:ReturnCustomer)',
            'setItemsRemoved'     => 'boolean(x:ItemsRemoved)',
	);
    }

    /**
     * @see Radial_RiskService_Sdk_IShoppingSession::getTimeOnSite()
     */
    public function getTimeOnSite()
    {
        return $this->_timeOnSite;
    }

    /**
     * @see Radial_RiskService_Sdk_IShoppingSession::setTimeOnSite()
     */
    public function setTimeOnSite($timeOnSite)
    {
        $this->_timeOnSite = $timeOnSite;
        return $this;
    }

    /**
     * @see Radial_RiskService_Sdk_IShoppingSession::getReturnCustomer()
     */
    public function getReturnCustomer()
    {
        return $this->_returnCustomer;
    }

    /**
     * @see Radial_RiskService_Sdk_IShoppingSession::setReturnCustomer()
     */
    public function setReturnCustomer($returnCustomer)
    {
        $this->_returnCustomer = $returnCustomer;
        return $this;
    }

    /**
     * @see Radial_RiskService_Sdk_IShoppingSession::getItemsRemoved()
     */
    public function getItemsRemoved()
    {
        return $this->_itemsRemoved;
    }

    /**
     * @see Radial_RiskService_Sdk_IShoppingSession::setItemsRemoved()
     */
    public function setItemsRemoved($itemsRemoved)
    {
        $this->_itemsRemoved = $itemsRemoved;
        return $this;
    }

    /**
     * @see Radial_RiskService_Sdk_Payload::setHttpHeaders()
     */
    protected function _canSerialize()
    {
        return (trim($this->getTimeOnSite()) !== ''|| trim($this->getReturnCustomer()) !== '' || trim($this->getItemsRemoved()));
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
        return $this->_serializeNode('TimeOnSite', $this->getTimeOnSite())
        . $this->_serializeBooleanNode('ReturnCustomer', $this->getReturnCustomer())
        . $this->_serializeBooleanNode('ItemsRemoved', $this->getItemsRemoved());
    }
}
