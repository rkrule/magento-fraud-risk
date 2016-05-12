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

interface EbayEnterprise_RiskService_Sdk_Device_IInfo extends EbayEnterprise_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'DeviceInfo';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';
	const HTTP_HEADERS_MODEL ='EbayEnterprise_RiskService_Sdk_Http_Headers';

	/**
	 * xsd restrictions: <= 1500 characters
	 * @return string
	 */
	public function getJSCData();

	/**
	 * @param   string
	 * @return  self
	 */
	public function setJSCData($jscData);

	/**
         * xsd restrictions: <= 255 characters
         * @return string
         */
        public function getSessionID();

        /**
         * @param   string
         * @return  self
         */
        public function setSessionID($sessionID);

	/**
	 * xsd restrictions: <= 15 characters
	 * @return string
	 */
	public function getDeviceIP();

	/**
	 * @param  string
	 * @return self
	 */
	public function setDeviceIP($deviceIP);

	/**
         * xsd restrictions: <= 100 characters
         * @return string
         */
        public function getDeviceHostname();

        /**
         * @param  string
         * @return self
         */
        public function setDeviceHostname($deviceHostname);

	/**
         * @return string
         */
        public function getUserCookie();
        
        /**
         * @param  string
         * @return self
         */
        public function setUserCookie($userCookie);

	/**
	 * @return EbayEnterprise_RiskService_Sdk_Http_Headers
	 */
	public function getHttpHeaders();

	/**
	 * @param  EbayEnterprise_RiskService_Sdk_Http_Headers
	 * @return self
	 */
	public function setHttpHeaders(EbayEnterprise_RiskService_Sdk_Http_Headers $httpHeaders);
}
