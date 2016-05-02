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

/**
 * @codeCoverageIgnore
 */
class EbayEnterprise_RiskService_Sdk_Config
	implements EbayEnterprise_RiskService_Sdk_IConfig
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
	/** @var EbayEnterprise_RiskService_Sdk_IPayload */
	protected $_request;
	/** @var EbayEnterprise_RiskService_Sdk_IPayload */
	protected $_response;
	/** @var EbayEnterprise_RiskService_Sdk_IPayload */
	protected $_error;

	/**
	 * @param array $initParams Must have this key:
	 *                          - 'api_key' => string
	 *                          - 'host' => string
	 *                          - 'store_id' => string
	 *                          - 'request' => EbayEnterprise_RiskService_Sdk_IPayload
	 *                          - 'response' => EbayEnterprise_RiskService_Sdk_IPayload
	 *                          - 'error' => EbayEnterprise_RiskService_Sdk_IPayload
	 */
	public function __construct(array $initParams=array())
	{
		list(
			$this->_apiKey,
			$this->_host,
			$this->_storeId,
			$this->_request,
			$this->_response,
			$this->_error
		) = $this->_checkTypes(
			$this->_nullCoalesce($initParams, 'api_key', null),
			$this->_nullCoalesce($initParams, 'host', null),
			$this->_nullCoalesce($initParams, 'store_id', null),
			$this->_nullCoalesce($initParams, 'request', $this->_getNewInstance('EbayEnterprise_RiskService_Sdk_Request')),
			$this->_nullCoalesce($initParams, 'response', $this->_getNewInstance('EbayEnterprise_RiskService_Sdk_Response')),
			$this->_nullCoalesce($initParams, 'error', $this->_getNewInstance('EbayEnterprise_RiskService_Sdk_Error'))
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
	 * @param  EbayEnterprise_RiskService_Sdk_IPayload
	 * @param  EbayEnterprise_RiskService_Sdk_IPayload
	 * @param  EbayEnterprise_RiskService_Sdk_IPayload
	 * @return array
	 */
	protected function _checkTypes(
		$apiKey,
		$host,
		$storeId,
		EbayEnterprise_RiskService_Sdk_IPayload $request,
		EbayEnterprise_RiskService_Sdk_IPayload $response,
		EbayEnterprise_RiskService_Sdk_IPayload $error
	) {
		return array($apiKey, $host, $storeId, $request, $response, $error);
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
	 * @see EbayEnterprise_RiskService_Sdk_IConfig::getRequest()
	 */
	public function getRequest()
	{
		return $this->_request;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IConfig::setRequest()
	 */
	public function setRequest(EbayEnterprise_RiskService_Sdk_IPayload $request)
	{
		$this->_request = $request;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IConfig::getResponse()
	 */
	public function getResponse()
	{
		return $this->_response;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IConfig::setResponse()
	 */
	public function setResponse(EbayEnterprise_RiskService_Sdk_IPayload $response)
	{
		$this->_response = $response;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IConfig::getError()
	 */
	public function getError()
	{
		return $this->_error;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IConfig::setError()
	 */
	public function setError(EbayEnterprise_RiskService_Sdk_IPayload $error)
	{
		$this->_error = $error;
		return $this;
	}
}
