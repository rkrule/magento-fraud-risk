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

class EbayEnterprise_Eb2cFraud_Model_Build_OCRequest
    extends EbayEnterprise_Eb2cFraud_Model_Abstract
    implements EbayEnterprise_Eb2cFraud_Model_Build_IOCRequest
{
    /** @var EbayEnterprise_RiskService_Sdk_IPayload */
    protected $_request;
    /** @var EbayEnterprise_Eb2cFraud_Model_Risk_Service */
    protected $_service;
    /** @var Mage_Sales_Model_Order */
    protected $_order;
    /** @var Mage_Sales_Model_Quote */
    protected $_quote;
    /** @var EbayEnterprise_Eb2cFraud_Helper_Data */
    protected $_helper;
    /** @var EbayEnterprise_Eb2cFraud_Helper_Http */
    protected $_httpHelper;
    /** @var EbayEnterprise_Eb2cFraud_Helper_Config */
    protected $_config;
    /** @var Mage_Catalog_Model_Product */
    protected $_product;

    /**
     * @param array $initParams Must have this key:
     *                          - 'request' => EbayEnterprise_RiskService_Sdk_IPayload
     *                          - 'order' => Mage_Sales_Model_Order
     *                          - 'quote' => Mage_Sales_Model_Quote
     *                          - 'helper' => EbayEnterprise_Eb2cFraud_Helper_Data
     *                          - 'product' => Mage_Catalog_Model_Product
     *				- 'config'  => EbayEnterprise_Eb2cFraud_Helper_config
     */
    public function __construct(array $initParams=array())
    {
        list($this->_request, $this->_order, $this->_quote, $this->_helper, $this->_httpHelper, $this->_product, $this->_config, $this->_service) = $this->_checkTypes(
            $this->_nullCoalesce($initParams, 'request', $this->_getNewSdkInstance('EbayEnterprise_RiskService_Sdk_OrderConfirmationRequest')),
            $this->_nullCoalesce($initParams, 'order', $initParams['order']),
            $this->_nullCoalesce($initParams, 'quote', Mage::getModel('sales/quote')),
            $this->_nullCoalesce($initParams, 'helper', Mage::helper('eb2cfraud')),
            $this->_nullCoalesce($initParams, 'http_helper', Mage::helper('eb2cfraud/http')),
            $this->_nullCoalesce($initParams, 'product', Mage::getModel('catalog/product')),
	    $this->_nullCoalesce($initParams, 'config', Mage::helper('eb2cfraud/config')),
	    $this->_nullCoalesce($initParams, 'service', Mage::getModel('eb2cfraud/risk_service'))
        );
    }

    /**
     * Type hinting for self::__construct $initParams
     *
     * @param  EbayEnterprise_RiskService_Sdk_IPayload
     * @param  Mage_Sales_Model_Order
     * @param  Mage_Sales_Model_Quote
     * @param  EbayEnterprise_Eb2cFraud_Helper_Data
     * @param  EbayEnterprise_Eb2cFraud_Helper_Http
     * @param  Mage_Catalog_Model_Product
     * @param  EbayEnterprise_Eb2cFraud_Helper_Config
     * @param  EbayEnterprise_Eb2cFraud_Model_Risk_Service
     * @return array
     */
    protected function _checkTypes(
        EbayEnterprise_RiskService_Sdk_IPayload $request,
        Mage_Sales_Model_Order $order,
        Mage_Sales_Model_Quote $quote,
        EbayEnterprise_Eb2cFraud_Helper_Data $helper,
        EbayEnterprise_Eb2cFraud_Helper_Http $httpHelper,
        Mage_Catalog_Model_Product $product,
	EbayEnterprise_Eb2cFraud_Helper_Config $config,
	EbayEnterprise_Eb2cFraud_Model_Risk_Service $service
    ) {
        return array($request, $order, $quote, $helper, $httpHelper, $product, $config, $service);
    }

    public function build()
    {
        $this->_buildRequest();
        return $this->_request;
    }

    /**
     * @return self
     */
    protected function _buildRequest()
    {
        $this->_buildOrder($this->_request->getOrder());
        return $this;
    }

    /**
     * @param  EbayEnterprise_RiskService_Sdk_IOCROrder
     * @return self
     */
    protected function _buildOrder(EbayEnterprise_RiskService_Sdk_IOCROrder $subPayloadOrder)
    {
        $subPayloadOrder->setOrderId($this->_order->getIncrementId());
	$subPayloadOrder->setStoreId($this->_config->getStoreId());
	
	$statusDate =  date("Y-m-d\TH:i:s.000\Z", Mage::getModel('core/date')->timestamp(time()));
	$subPayloadOrder->setStatusDate($statusDate);

	$subPayloadOrder->setConfirmationType($this->_config->getOrderStateForConfirmationFraudOCR($this->_order->getState()));
	$subPayloadOrder->setOrderStatus($this->_config->getOrderStateForFraudOCR($this->_order->getState()));

	$this->_buildLineDetails($subPayloadOrder->getLineDetails());

        return $this;
    }

    /**
     * @param  EbayEnterprise_RiskService_Sdk_Line_IDetails
     * @return self
     */
    protected function _buildLineDetails(EbayEnterprise_RiskService_Sdk_Line_IDetails $subPayloadLineDetails)
    {
        foreach ($this->_order->getAllItems() as $orderItem) {
            $subPayloadLineDetail = $subPayloadLineDetails->getEmptyLineDetail();
            $this->_buildLineDetail($subPayloadLineDetail, $orderItem);
            $subPayloadLineDetails->offsetSet($subPayloadLineDetail);
        }
        return $this;
    }

    /**
     * @param  EbayEnterprise_RiskService_Sdk_Line_IItem
     * @param  Mage_Core_Model_Abstract
     * @return self
     */
    protected function _buildLineDetail(
        EbayEnterprise_RiskService_Sdk_Line_IDetail $subPayloadLineDetail,
        Mage_Core_Model_Abstract $orderItem
    )
    {
	$subPayloadLineDetail->setSKU($orderItem->getSku())
			->setQuantity((int) $orderItem->getQtyOrdered());

	$subPayloadLineDetail->setItemStatus($this->_config->getItemStateForFraudOCR($orderItem->getStatus()));

        return $this;
    }
}
