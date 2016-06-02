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
class Radial_RiskService_Sdk_Config
	implements Radial_RiskService_Sdk_IConfig
{
	/** @var string */
	protected $_apiKey;
	/** @var string */
	protected $_host;
	/** @var string */
	protected $_storeId;
	/** @var string */
	protected $_action = '_post';
	/** @var string */
	protected $_contentType = 'text/xml';
	/** @var Radial_RiskService_Sdk_IPayload */
	protected $_request;
	/** @var Radial_RiskService_Sdk_IPayload */
	protected $_OCrequest;
	/** @var Radial_RiskService_Sdk_IPayload */
	protected $_response;
	/** @var Radial_RiskService_Sdk_IPayload *.
	protected $_OCresponse;
	/** @var Radial_RiskService_Sdk_IPayload */
	protected $_error;

	/**
	 * @param array $initParams Must have this key:
	 *                          - 'api_key' => string
	 *                          - 'host' => string
	 *                          - 'store_id' => string
	 *                          - 'request' => Radial_RiskService_Sdk_IPayload
	 *                          - 'response' => Radial_RiskService_Sdk_IPayload
	 *                          - 'error' => Radial_RiskService_Sdk_IPayload
	 *			    - 'ocresponse' => Radial_RiskService_Sdk_IPayload
	 *			    - 'ocrequest' => Radial_RiskService_Sdk_IPayload
	 */
	public function __construct(array $initParams=array())
	{
		list(
			$this->_apiKey,
			$this->_host,
			$this->_storeId,
			$this->_request,
			$this->_response,
			$this->_error,
			$this->_OCresponse,
			$this->_OCrequest
		) = $this->_checkTypes(
			$this->_nullCoalesce($initParams, 'api_key', null),
			$this->_nullCoalesce($initParams, 'host', null),
			$this->_nullCoalesce($initParams, 'store_id', null),
			$this->_nullCoalesce($initParams, 'request', $this->_getNewInstance('Radial_RiskService_Sdk_Request')),
			$this->_nullCoalesce($initParams, 'response', $this->_getNewInstance('Radial_RiskService_Sdk_Response')),
			$this->_nullCoalesce($initParams, 'error', $this->_getNewInstance('Radial_RiskService_Sdk_Error')),
			$this->_nullCoalesce($initParams, 'ocresponse', $this->_getNewInstance('Radial_RiskService_Sdk_OCResponse')),
			$this->_nullCoalesce($initParams, 'ocrequest', $this->_getNewInstance('Radial_RiskService_Sdk_OrderConfirmationRequest'))
		);
	}

	/**
	 * Get a new SDK payload instance.
	 *
	 * @param  string
	 * @param  mixed
	 * @return mixed
	 */
	protected function _getNewInstance($class, $arguments=array())
	{
		return new $class($arguments);
	}

	/**
	 * Type hinting for self::__construct $initParams
	 *
	 * @param  string
	 * @param  string
	 * @param  string
	 * @param  Radial_RiskService_Sdk_IPayload
	 * @param  Radial_RiskService_Sdk_IPayload
	 * @param  Radial_RiskService_Sdk_IPayload
	 * @param  Radial_RiskService_Sdk_IPayload
	 * @param  Radial_RiskService_Sdk_IPayload
	 * @return array
	 */
	protected function _checkTypes(
		$apiKey,
		$host,
		$storeId,
		Radial_RiskService_Sdk_IPayload $request,
		Radial_RiskService_Sdk_IPayload $response,
		Radial_RiskService_Sdk_IPayload $error,
		Radial_RiskService_Sdk_IPayload $ocresponse,
		Radial_RiskService_Sdk_IPayload $ocrequest
	) {
		return array($apiKey, $host, $storeId, $request, $response, $error, $ocresponse, $ocrequest);
	}

	/**
	 * Return the value at field in array if it exists. Otherwise, use the default value.
	 *
	 * @param  array
	 * @param  string | int $field Valid array key
	 * @param  mixed
	 * @return mixed
	 */
	protected function _nullCoalesce(array $arr, $field, $default)
	{
		return isset($arr[$field]) ? $arr[$field] : $default;
	}

	/**
	 * @return string
	 */
	public function getApiKey()
	{
		return $this->_apiKey;
	}

	/**
	 * @return string
	 */
	public function getStoreId()
	{
		return $this->_storeId;
	}

	/**
	 * @return string
	 */
	public function getEndpoint()
	{
		return $this->_host;
	}

	/**
	 * @return string
	 */
	public function getHttpMethod()
	{
		return $this->_action;
	}

	/**
	 * @return string
	 */
	public function getContentType()
	{
		return $this->_contentType;
	}

	/**
	 * @see Radial_RiskService_Sdk_IConfig::getRequest()
	 */
	public function getRequest()
	{
		return $this->_request;
	}

	/**
	 * @see Radial_RiskService_Sdk_IConfig::setRequest()
	 */
	public function setRequest(Radial_RiskService_Sdk_IPayload $request)
	{
		$this->_request = $request;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_IConfig::getOCRequest()
         */
        public function getOCRequest()
        {
                return $this->_OCrequest;
        }

        /**
         * @see Radial_RiskService_Sdk_IConfig::setRequest()
         */
        public function setOCRequest(Radial_RiskService_Sdk_IPayload $request)
        {
                $this->_OCrequest = $request;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_IConfig::getResponse()
	 */
	public function getResponse()
	{
		return $this->_response;
	}

	/**
	 * @see Radial_RiskService_Sdk_IConfig::setResponse()
	 */
	public function setResponse(Radial_RiskService_Sdk_IPayload $response)
	{
		$this->_response = $response;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_IConfig::getOCResponse()
         */
        public function getOCResponse()
        {
                return $this->_OCresponse;
        }

        /**
         * @see Radial_RiskService_Sdk_IConfig::setOCResponse()
         */
        public function setOCResponse(Radial_RiskService_Sdk_IPayload $response)
        {
                $this->_OCresponse = $response;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_IConfig::getError()
	 */
	public function getError()
	{
		return $this->_error;
	}

	/**
	 * @see Radial_RiskService_Sdk_IConfig::setError()
	 */
	public function setError(Radial_RiskService_Sdk_IPayload $error)
	{
		$this->_error = $error;
		return $this;
	}
}
