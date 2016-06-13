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

/**
 * @codeCoverageIgnore
 */
class Radial_RiskService_Sdk_Api
	implements Radial_RiskService_Sdk_IApi
{
	/** @var Radial_RiskService_Sdk_IConfig */
	protected $_config;
	/** @var Radial_RiskService_Sdk_IPayload */
	protected $_requestPayload;
	/** @var  Radial_RiskService_Sdk_IPayload */
	protected $_replyPayload;
	/** @var  Requests_Response $_lastRequestsResponse - Response object from the last call to Requests */
	protected $_lastRequestsResponse;
	/** @var Radial_RiskService_Sdk_Helper_Config */
	protected $_helperConfig;

	/**
	 * Configure the API by supplying an object that informs
	 * what payload object to use, what URI to send to, etc.
	 *
	 * @param Radial_RiskService_Sdk_Config
	 */
	public function __construct(Radial_RiskService_Sdk_Config $config)
	{
		$this->_config = $config;
		$this->_helperConfig = Mage::helper('radial_eb2cfraud/config');
		Requests::register_autoloader();
	}

	/**
	 * @see Radial_RiskService_Sdk_IApi::setRequestBody()
	 */
	public function setRequestBody(Radial_RiskService_Sdk_IPayload $payload)
	{
		$this->_requestPayload = $payload;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_IApi::send()
	 */
	public function send()
	{
		$this->getRequestBody()->serialize();

		// actually do the request
		try {
			if ($this->_sendRequest() === false) {
				$message = sprintf(
					"HTTP result %s for %s to %s.\n%s",
					$this->_lastRequestsResponse->status_code,
					$this->_config->getHttpMethod(),
					$this->_lastRequestsResponse->url,
					$this->_lastRequestsResponse->body
				);
				throw Mage::exception('Radial_RiskService_Sdk_Exception_Network_Error', $message);
			}
		} catch (Requests_Exception $e) {
			// simply pass through the message but with an expected exception type - don't
			// have any request/response to include as this exception only occurs
			// when the request cannot even be attempted.
			throw Mage::exception('Radial_RiskService_Sdk_Exception_Network_Error', $e->getMessage());
		}

		$this->_deserializeResponse($this->_lastRequestsResponse->body);
		return $this;
	}

	/**
	 * Deserialized the response xml into response payload if an exception is thrown catch it
	 * and set the error payload and deserialized the response xml into it.
	 *
	 * @param  string
	 * @return self
	 */
	protected function _deserializeResponse($responseData)
	{
		try {
			$this->getResponseBody()->deserialize($responseData);
		} catch (Radial_RiskService_Sdk_Exception_Invalid_Payload_Exception $e) {
			$logMessage = sprintf('[%s] Error Payload Response Body: %s', __CLASS__, $this->cleanAuthXml($responseData));
                        Mage::log($logMessage, Zend_Log::WARN);
		}
		if ($this->_helperConfig->isDebugMode()) {
			$logMessage = sprintf('[%s] Response Body: %s', __CLASS__, $this->cleanAuthXml($responseData));
			Mage::log($logMessage, Zend_Log::DEBUG);
		}
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_IApi::getRequestBody()
	 */
	public function getRequestBody()
	{
		if ($this->_requestPayload !== null) {
			return $this->_requestPayload;
		}
		// If a payload doesn't exist for the request, the operation cannot
		// be supported.
		try {
			$this->_requestPayload = $this->_config->getRequest();	
		} catch (Radial_RiskService_Sdk_Exception_Unsupported_Payload_Exception $e) {
			$this->_requestPayload = $this->_config->getOCRequest();
 	
 			if(!$this->_requestPayload)
 			{
 				throw Mage::exception('Radial_RiskService_Sdk_Exception_Unsupported_Operation', '');
 			}
		}
		return $this->_requestPayload;
	}

	/**
	 * @see Radial_RiskService_Sdk_IApi::getResponseBody()
	 */
	public function getResponseBody()
	{
		if ($this->_replyPayload !== null) {
			return $this->_replyPayload;
		}

		// If a payload doesn't exist for the response, the operation cannot
		// be supported.
		try {
			$xml = simplexml_load_string($this->_lastRequestsResponse->body);
                	if( strcmp($xml->getName(), "RiskOrderConfirmationReply") === 0)
                	{
				$this->_replyPayload = $this->_config->getOCResponse();
			} else {
				$this->_replyPayload = $this->_config->getResponse();
			}
		} catch (Radial_RiskService_Sdk_Exception_Unsupported_Payload_Exception $e) {
			throw Mage::exception('Radial_RiskService_Sdk_Exception_Unsupported_Operation', '');
		}
		return $this->_replyPayload;
	}

	/**
	 * Set the reply payload as the error payload
	 *
	 * @return self
	 */
	protected function _setErrorResponseBody()
	{
		$this->_replyPayload = $this->_config->getError();

		return $this;
	}

	/**
	 * Send get or post CURL request to the API URI.
	 *
	 * @return boolean
	 * @throws Radial_RiskService_Sdk_Exception_Unsupported_Http_Action_Exception
	 */
	protected function _sendRequest()
	{
		// clear the old response
		$this->_lastRequestsResponse = null;
		$httpMethod = strtolower($this->_config->getHttpMethod());
		if (!method_exists($this, $httpMethod)) {
			throw Mage::exception(
				'Radial_RiskService_Sdk_Exception_Unsupported_Http_Action',
				sprintf('HTTP action %s not supported.', strtoupper($httpMethod))
			);
		}

		return $this->$httpMethod();
	}

	/**
	 * Send post CURL request.
	 *
	 * @return Requests_Response
	 * @throws Requests_Exception
	 */
	protected function _post()
	{
		$requestXml = $this->getRequestBody()->serialize();
		if ($this->_helperConfig->isDebugMode()) {
			$logMessage = sprintf('[%s] Request Body: %s', __CLASS__, $this->cleanAuthXml($requestXml));
			Mage::log($logMessage, Zend_Log::DEBUG);
		}

		$xml = simplexml_load_string($requestXml);
		if( strcmp($xml->getName(), "RiskAssessmentRequest") === 0)
		{
			//Note this is a really crude way of doing this, but since this SDK is only for Risk Assess right now... IDC
			$hostname = "https://". $this->_config->getEndpoint() . "/v1.0/stores/". $this->_config->getStoreId() . "/risk/fraud/assess.xml";
		} elseif ( strcmp($xml->getName(), "RiskOrderConfirmationRequest") === 0 ) {
			//Note this is a really crude way of doing this, but since this SDK is only for Risk Assess right now... IDC
                        $hostname = "https://". $this->_config->getEndpoint() . "/v1.0/stores/". $this->_config->getStoreId() . "/risk/fraud/orderConfirmation.xml";
		} else {
			throw Mage::exception('Radial_RiskService_Sdk_Exception_Network_Error', "Unsupported Payload - ". $xml->getName());
		}

		$this->_lastRequestsResponse = Requests::post(
			$hostname,
			$this->_buildHeader(),
			$requestXml
		);
		return $this->_lastRequestsResponse->success;
	}

	/**
	 * Build the CURL headers.
	 *
	 * @return array
	 */
	protected function _buildHeader()
	{
		return array(
			'apikey' => $this->_config->getApiKey(),
			'Content-type' => $this->_config->getContentType()
		);
	}

	/**
	 * Send get CURL request.
	 *
	 * @return Requests_Response
	 * @throws Requests_Exception
	 */
	protected function _get()
	{
		$this->_lastRequestsResponse = Requests::post(
			$this->_config->getEndpoint(),
			$this->_buildHeader()
		);
		return $this->_lastRequestsResponse->success;
	}

	/**
         * Scrub the auth request XML message of any sensitive data - CVV, CC number.
         * @param  string $xml
         * @return string
         */
        public function cleanAuthXml($xml)
        {
             $xml = preg_replace('#(\<(?:Encrypted)?CardSecurityCode\>).*(\</(?:Encrypted)?CardSecurityCode\>)#', '$1***$2', $xml);
             $xml = preg_replace('#(\<(?:Encrypted)?PaymentAccountUniqueId.*?\>).*(\</(?:Encrypted)?PaymentAccountUniqueId\>)#', '$1***$2', $xml);
             $xml = preg_replace('#(\<(?:Encrypted)?AccountID.*?\>).*(\</(?:Encrypted)?AccountID\>)#', '$1***$2', $xml);
             return $xml;
        }
}
