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

class EbayEnterprise_Eb2cFraud_Model_Risk_Order
	extends EbayEnterprise_Eb2cFraud_Model_Abstract
	implements EbayEnterprise_Eb2cFraud_Model_Risk_IOrder
{
	/** @var EbayEnterprise_Eb2cFraud_Helper_Data */
	protected $_helper;
	/** @var EbayEnterprise_Eb2cFraud_Helper_Config */
	protected $_config;
	/** @var EbayEnterprise_Eb2cFraud_Helper_Http */
	protected $_httpHelper;
    	/** @var EbayEnterprise_RiskService_Sdk_Request */
    	protected $_request;
	/** @var EbayEnterprise_RiskService_Sdk_Response */
	protected $_response;

	/**
	 * @param array $initParams optional keys:
	 *                          - 'helper' => EbayEnterprise_Eb2cFraud_Helper_Data
	 *			    - 'httpHelper' => EbayEnterprise_Eb2cFraud_Helper_Http
	 *                          - 'config' => EbayEnterprise_Eb2cFraud_Helper_Config
	 */
	public function __construct(array $initParams=array())
	{

		list($this->_helper, $this->_httpHelper, $this->_request, $this->_config, $this->_response) = $this->_checkTypes(
			$this->_nullCoalesce($initParams, 'helper', Mage::helper('eb2cfraud')),
			$this->_nullCoalesce($initParams, 'http_helper', Mage::helper('eb2cfraud/http')),
		        $this->_nullCoalesce($initParams, 'request', $this->_getNewSdkInstance('EbayEnterprise_RiskService_Sdk_Request')),
			$this->_nullCoalesce($initParams, 'config', Mage::helper('eb2cfraud/config')),
			$this->_nullCoalesce($initParams, 'request', $this->_getNewSdkInstance('EbayEnterprise_RiskService_Sdk_Response'))
		);
	}

	/**
	 * Type hinting for self::__construct $initParams
	 *
	 * @param  EbayEnterprise_Eb2cFraud_Helper_Data
	 * @param  EbayEnterprise_Eb2cFraud_Helper_Http
	 * @param  EbayEnterprise_Eb2cFraud_Helper_Config
	 * @return array
	 */
	protected function _checkTypes(
		EbayEnterprise_Eb2cFraud_Helper_Data $helper,
		EbayEnterprise_Eb2cFraud_Helper_Http $httpHelper,
        EbayEnterprise_RiskService_Sdk_Request $request,
		EbayEnterprise_Eb2cFraud_Helper_Config $config,
		EbayEnterprise_RiskService_Sdk_Response $response
	) {
		return array($helper, $httpHelper, $request, $config, $response);
	}

    /**
         * Get new API config object.
         *
         * @param  EbayEnterprise_RiskService_Sdk_IPayload
         * @param  EbayEnterprise_RiskService_Sdk_IPayload
         * @return EbayEnterprise_RiskService_Sdk_IConfig
         */
        protected function _setupApiConfig(
                EbayEnterprise_RiskService_Sdk_IPayload $request,
                EbayEnterprise_RiskService_Sdk_IPayload $response
        )
        {
                return $this->_getNewSdkInstance('EbayEnterprise_RiskService_Sdk_Config', array(
                        'api_key' => $this->_config->getApiKey(),
                        'host' => $this->_config->getApiHostname(),
                        'store_id' => $this->_config->getStoreId(),
                        'request' => $request,
                        'response' => $response,
                ));
        }

	/**
         * Get new API object.
         *
         * @param  EbayEnterprise_RiskService_Sdk_IConfig
         * @return EbayEnterprise_RiskService_Sdk_IApi
         * @codeCoverageIgnore
         */
        protected function _getApi(EbayEnterprise_RiskService_Sdk_IConfig $config)
        {
                return $this->_getNewSdkInstance('EbayEnterprise_RiskService_Sdk_Api', $config);
        }

	/**
         * @param  EbayEnterprise_RiskService_Sdk_IApi
         * @return EbayEnterprise_RiskService_Sdk_IPayload | null
         */
        protected function _sendRequest(EbayEnterprise_RiskService_Sdk_IApi $api)
        {
                $response = null;
                try {
                        $api->send();
                        $response = $api->getResponseBody();
                } catch (Exception $e) {
                        $logMessage = sprintf('[%s] The following error has occurred while sending request: %s', __CLASS__, $e->getMessage());
                        Mage::log($logMessage, Zend_Log::WARN);
                        Mage::logException($e);
                }
                return $response;
        }

    /**
     * Get new empty request payload
     *
     * @return EbayEnterprise_RiskService_Sdk_IPayload
     */
    protected function _getNewEmptyRequest()
    {
        return $this->_getNewSdkInstance('EbayEnterprise_RiskService_Sdk_Request');
    }

	/**
	 * Get new empty response payload
	 *
	 * @return EbayEnterprise_RiskInsight_Sdk_IPayload
	 */
	protected function _getNewEmptyResponse()
	{
		return $this->_getNewSdkInstance('EbayEnterprise_RiskService_Sdk_Response');
	}

	public function processRiskOrder(
		Mage_Sales_Model_Order $order, Varien_Event_Observer $observer
	)
	{
        $request = $this->_getNewEmptyRequest();

        $payload = Mage::getModel('eb2cfraud/build_request', array(
            'request' => $request,
            'order' => $order,
        ))->build();

	$apiConfig = $this->_setupApiConfig($payload, $this->_getNewEmptyResponse());
        $response = $this->_sendRequest($this->_getApi($apiConfig));

	Mage::Log("Response: ". print_r($response, true));

	/* Last Data Type to Add to Message
		$transResponsesNode = $domtree->createElementNS("http://api.gsicommerce.com/schema/checkout/1.0", "TransactionResponses");
		$cvv2Response = $paymentAdditional['cvv2_response_code'];
		$avsResponse = $paymentAdditional['avs_response_code'];		
		$approval = $paymentAdditional['response_code'];

		$transResponseCvv2Node = $domtree->createElementNS("http://api.gsicommerce.com/schema/checkout/1.0", "TransactionResponse", $cvv2Response);
		$transResponseAttr = $domtree->createAttribute('ResponseType');
		$transResponseAttr->value = "cvv2";
		$transResponseCvv2Node->appendChild($transResponseAttr);
		$transResponsesNode->appendChild($transResponseCvv2Node);

		$avsAddrResponseNode = 	$domtree->createElementNS("http://api.gsicommerce.com/schema/checkout/1.0", "TransactionResponse", $avsResponse);
		$avsAddrResponseAttr = $domtree->createAttribute('ResponseType');
		$avsAddrResponseAttr->value = "avsAddr";
		$avsAddrResponseNode->appendChild($avsAddrResponseAttr);
		$transResponsesNode->appendChild($avsAddrResponseNode);

		$avsAddrResponseNodeZip =  $domtree->createElementNS("http://api.gsicommerce.com/schema/checkout/1.0", "TransactionResponse", $avsResponse);
                $avsAddrResponseAttrZip = $domtree->createAttribute('ResponseType');
                $avsAddrResponseAttrZip->value = "avsZip";
                $avsAddrResponseNodeZip->appendChild($avsAddrResponseAttrZip);
                $transResponsesNode->appendChild($avsAddrResponseNodeZip);
	*/
	}
}
