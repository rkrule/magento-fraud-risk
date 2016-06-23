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

interface Radial_RiskService_Sdk_IRequest extends Radial_RiskService_Sdk_Payload_ITop
{
	const ROOT_NODE = 'RiskAssessmentRequest';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';
	const XSD = 'Risk-Service-RiskAssessment-1.0.xsd';
	const ORDER_MODEL ='Radial_RiskService_Sdk_Order';
    	const SERVER_INFO_MODEL = 'Radial_RiskService_Sdk_Server_Info';
    	const DEVICE_INFO_MODEL = 'Radial_RiskService_Sdk_Device_Info';
	const CUSTOM_PROPERTIES_MODEL = 'Radial_RiskService_Sdk_CustomProperties';

	/**
	 * Contain order detail information.
	 *
	 * @return Radial_RiskService_Sdk_IOrder
	 */
	public function getOrder();

	/**
	 * @param  Radial_RiskService_Sdk_IOrder
	 * @return self
	 */
	public function setOrder(Radial_RiskService_Sdk_IOrder $order);

    /**
     * @return Radial_RiskService_Sdk_Device_IInfo
     */
    public function getDeviceInfo();

    /**
     * @param  Radial_RiskService_Sdk_Device_IInfo
     * @return self
     */
    public function setDeviceInfo(Radial_RiskService_Sdk_Device_IInfo $deviceInfo);

    /**
     * @return Radial_RiskService_Sdk_Server_IInfo
     */
    public function getServerInfo();

    /**
     * @param  Radial_RiskService_Sdk_Server_IInfo
     * @return self
     */
    public function setServerInfo(Radial_RiskService_Sdk_Server_IInfo $serverInfo);

	/**
         * @return Radial_RiskService_Sdk_ICustomProperties
         */
        public function getCustomProperties();

        /**
         * @param Radial_RiskService_Sdk_ICustomProperties
         * @return  self
         */
        public function setCustomProperties(Radial_RiskService_Sdk_ICustomProperties $customProperties);
}
