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
 * http://www.radial.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf
 *
 * @copyright   Copyright (c) 2015 eBay Enterprise, Inc. (http://www.radial.com/)
 * @license     http://www.radial.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf  eBay Enterprise Magento Extensions End User License Agreement
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
	/** @var EbayEnterprise_MageLog_Helper_Data */
    	protected $_logger;
	/** @var EbayEnterprise_MageLog_Helper_Context */
   	protected $_context;
	/** @var payload message **/
	protected $_payloadXml;
	
	/**
	 * @param array $initParams optional keys:
	 *                          - 'helper' => EbayEnterprise_Eb2cFraud_Helper_Data
	 *			    - 'httpHelper' => EbayEnterprise_Eb2cFraud_Helper_Http
	 *                          - 'config' => EbayEnterprise_Eb2cFraud_Helper_Config
	 */
	public function __construct(array $initParams=array())
	{

		list($this->_helper, $this->_httpHelper, $this->_request, $this->_config, $this->_response, $this->_logger, $this->_context) = $this->_checkTypes(
			$this->_nullCoalesce($initParams, 'helper', Mage::helper('ebayenterprise_eb2cfraud')),
			$this->_nullCoalesce($initParams, 'http_helper', Mage::helper('ebayenterprise_eb2cfraud/http')),
		        $this->_nullCoalesce($initParams, 'request', $this->_getNewSdkInstance('EbayEnterprise_RiskService_Sdk_Request')),
			$this->_nullCoalesce($initParams, 'config', Mage::helper('ebayenterprise_eb2cfraud/config')),
			$this->_nullCoalesce($initParams, 'request', $this->_getNewSdkInstance('EbayEnterprise_RiskService_Sdk_Response')),
			$this->_nullCoalesce($initParams, 'logger', Mage::helper('ebayenterprise_magelog')),
			$this->_nullCoalesce($initParams, 'context', Mage::helper('ebayenterprise_magelog/context'))
		);
	}

	/**
	 * Type hinting for self::__construct $initParams
	 *
	 * @param  EbayEnterprise_Eb2cFraud_Helper_Data
	 * @param  EbayEnterprise_Eb2cFraud_Helper_Http
	 * @param  EbayEnterprise_Eb2cFraud_Helper_Config
	 * @param  EbayEnterprise_MageLog_Helper_Data
	 * @param  EbayEnterprise_MageLog_Helper_Context
	 * @return array
	 */
	protected function _checkTypes(
		EbayEnterprise_Eb2cFraud_Helper_Data $helper,
		EbayEnterprise_Eb2cFraud_Helper_Http $httpHelper,
        EbayEnterprise_RiskService_Sdk_Request $request,
		EbayEnterprise_Eb2cFraud_Helper_Config $config,
		EbayEnterprise_RiskService_Sdk_Response $response,
		EbayEnterprise_MageLog_Helper_Data $logger,
		EbayEnterprise_MageLog_Helper_Context $context
	) {
		return array($helper, $httpHelper, $request, $config, $response, $logger, $context);
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
        * Get new empty request payload
        *
        * @return EbayEnterprise_RiskService_Sdk_IPayload
        */
        protected function _getNewOCREmptyRequest()
        {
                return $this->_getNewSdkInstance('EbayEnterprise_RiskService_Sdk_OrderConfirmationRequest');
        }

	/**
         * @param  EbayEnterprise_RiskService_Sdk_IApi
         * @return EbayEnterprise_RiskService_Sdk_IPayload | null
         */
        protected function _sendRequest(EbayEnterprise_RiskService_Sdk_IApi $api, Mage_Sales_Model_Order $order )
        {
                $response = null;
                try {
                        $api->send();

			if( $order->getId() )
			{
				// Set order state / status below, then use order history collection
        			$order->setState("pending", "risk_submitted", 'Order has been submitted for Fraud Review.', false);
        			$order->save();
			}

                        $response = $api->getResponseBody();
                } catch (Exception $e) {
                        $logMessage = sprintf('[%s] The following error has occurred while sending request: %s', __CLASS__, $e->getMessage());
                        Mage::log($logMessage, Zend_Log::WARN);
                        Mage::logException($e);

			//Queue up for retry
			if (strlen($this->_payloadXml) > 0) {
				$xml = simplexml_load_string($this->_payloadXml);
				if( strcmp( $xml->getName(), "RiskAssessmentRequest") === 0)
				{
					$eventName = 'risk_assessment_request';
				} elseif (  strcmp( $xml->getName(), "RiskOrderConfirmationRequest") === 0) {
					$eventName = 'order_confirmation_request';
				} else {
					$eventName = 'not_supported';
				}

				$object = Mage::getModel('ebayenterprise_eb2cfraud/retryQueue');
	        		$time = time();
	        		$data = array('event_name' => $eventName, 'created_at' => $time, 'message_content' => $this->_payloadXml);
	        		$object->setData($data);
	        		$object->save();
			}
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

        $payload = Mage::getModel('ebayenterprise_eb2cfraud/build_request', array(
            'request' => $request,
            'order' => $order,
        ))->build();

	$this->_payloadXml = $payload->serialize();

	$apiConfig = $this->_setupApiConfig($payload, $this->_getNewEmptyResponse());
        $response = $this->_sendRequest($this->_getApi($apiConfig), $order);

	// Set order state / status below, then use order history collection
	$order->setState("pending", "risk_processing", 'Order is now processing in the Fraud System.', false);
	$order->save();
	}

        public function processOrderConfirmationRequest(Varien_Event_Observer $observer)
        {
                $order = $observer->getOrder();
		$orderNull = Mage::getModel('sales/order');

                $request = $this->_getNewOCREmptyRequest();

                $payload = Mage::getModel('ebayenterprise_eb2cfraud/build_OCRequest', array(
                	'request' => $request,
                        'order' => $order,
                ))->build();

		$this->_payloadXml = $payload->serialize();
        	$apiConfig = $this->_setupApiConfig($payload, $this->_getNewEmptyResponse());
        	$response = $this->_sendRequest($this->_getApi($apiConfig), $orderNull);
        }


	/**
     * Sends the event from the database to Sonic, as configured in local.xml
     */
    public function sendEvent() {
        $objectCollection = Mage::getModel('ebayenterprise_eb2cfraud/retryQueue')->getCollection()->setPageSize(100);
	$order = Mage::getModel('sales/order');

        foreach( $objectCollection as $object )
        {
		$this->_payloadXml = $this->_request->deserialize($object->getMessageContent());

        	$apiConfig = $this->_setupApiConfig($this->_payloadXml, $this->_getNewEmptyResponse());
        	$response = $this->_sendRequest($this->_getApi($apiConfig), $order);

		$object->delete();
        }
    }
}
