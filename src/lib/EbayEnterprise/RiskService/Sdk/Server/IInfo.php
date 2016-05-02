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

interface EbayEnterprise_RiskService_Sdk_Server_IInfo extends EbayEnterprise_RiskService_Sdk_IPayload
{
	const HTTP_HEADER_MODEL = 'EbayEnterprise_RiskService_Sdk_Server_Info';
	const ROOT_NODE = 'ServerInfo';
	const SUBPAYLOAD_XPATH = 'ServerInfo';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

	 /**
         * @return EbayEnterprise_RiskService_Sdk_Server_IInfo
         */
        public function getTime();

        /**
         * @param  EbayEnterprise_RiskService_Sdk_Server_IInfo
         * @return self
         */
        public function setTime(EbayEnterprise_RiskService_Sdk_Server_IInfo $time);

	/**
         * @return EbayEnterprise_RiskService_Sdk_Server_IInfo
         */
        public function getTZOffset();

        /**
         * @param  EbayEnterprise_RiskService_Sdk_Server_IInfo
         * @return self
         */
        public function setTZOffset(EbayEnterprise_RiskService_Sdk_Server_IInfo $tzOffset);

	/**
         * @return EbayEnterprise_RiskService_Sdk_Server_IInfo
         */
        public function getTZOffsetRaw();

        /**
         * @param  EbayEnterprise_RiskService_Sdk_Server_IInfo
         * @return self
         */
        public function setTZOffsetRaw(EbayEnterprise_RiskService_Sdk_Server_IInfo $tzOffsetRaw);

	/**
         * @return EbayEnterprise_RiskService_Sdk_Server_IInfo
         */
        public function getDSTActive();

        /**
         * @param  EbayEnterprise_RiskService_Sdk_Server_IInfo
         * @return self
         */
        public function setDSTActive(EbayEnterprise_RiskService_Sdk_Server_IInfo $dstActive);
}
