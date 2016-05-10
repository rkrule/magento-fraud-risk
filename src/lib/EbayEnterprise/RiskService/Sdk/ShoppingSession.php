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

class EbayEnterprise_RiskService_Sdk_ShoppingSession
    extends EbayEnterprise_RiskService_Sdk_Payload
    implements EbayEnterprise_RiskService_Sdk_IShoppingSession
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
            'setTimeOnSite' => 'x:TimeOnSite',
        );
        $this->_booleanExtractionPaths = array (
            'setReturnCustomer' => 'x:ReturnCustomer',
            'setItemsRemoved'     => 'x:ItemsRemoved',
        );
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_IShoppingSession::getTimeOnSite()
     */
    public function getTimeOnSite()
    {
        return $this->_timeOnSite;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_IShoppingSession::setTimeOnSite()
     */
    public function setTimeOnSite($timeOnSite)
    {
        $this->_timeOnSite = $timeOnSite;
        return $this;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_IShoppingSession::getReturnCustomer()
     */
    public function getReturnCustomer()
    {
        return $this->_returnCustomer;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_IShoppingSession::setReturnCustomer()
     */
    public function setReturnCustomer($returnCustomer)
    {
        $this->_returnCustomer = $returnCustomer;
        return $this;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_IShoppingSession::getItemsRemoved()
     */
    public function getItemsRemoved()
    {
        return $this->_itemsRemoved;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_IShoppingSession::setItemsRemoved()
     */
    public function setItemsRemoved($itemsRemoved)
    {
        $this->_itemsRemoved = $itemsRemoved;
        return $this;
    }

    /**
     * @see EbayEnterprise_RiskService_Sdk_Payload::setHttpHeaders()
     */
    protected function _canSerialize()
    {
        return (trim($this->getTimeOnSite()) !== ''|| trim($this->getReturnCustomer()) !== '' || trim($this->getItemsRemoved()));
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
        return $this->_serializeNode('TimeOnSite', $this->getTimeOnSite())
        . $this->_serializeNode('ReturnCustomer', $this->getReturnCustomer())
        . $this->_serializeNode('ItemsRemoved', $this->getItemsRemoved());
    }
}
