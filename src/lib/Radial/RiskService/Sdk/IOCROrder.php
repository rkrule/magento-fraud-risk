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

interface Radial_RiskService_Sdk_IOCROrder extends Radial_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'Order';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';
	const XSD = 'Risk-OrderConfirmationRequest-1.0.xsd';
	const LINE_DETAILS_MODEL ='Radial_RiskService_Sdk_Line_Details';
	const CUSTOM_ATTRIBUTES_LIST_MODEL = 'Radial_RiskService_Sdk_CustomAttributes_List';

	/**
	 * Order ID 
	 *
	 * @return string 
	 */
	public function getOrderId();

	/**
	 * @param  string 
	 * @return self
	 */
	public function setOrderId($orderId);

	/**
	 * Store ID
	 *
	 * @return string
	 */
	public function getStoreId();

	/**
	 * @param  string
	 * @return self
	 *
	 */
	public function setStoreId($storeId);

	/**
	 * StatusDate
	 * 
	 * @return string 
	 */
	public function getStatusDate();

	/**
	 * @param  string
	 * @return self
	 *
	 */
	public function setStatusDate(DateTime $statusDate);

	/**
	 * ConfirmationType
	 * 
	 * @return string
	 */
	public function getConfirmationType();

	/**
	 * @param   string
	 * @return  self
	 *
	 */
	public function setConfirmationType($confirmationType);

	/**
	 * OrderStatus
	 *
	 * @return string
	 */
	public function getOrderStatus();

	/**
	 * @param  string
	 * @return self
	 *
	 */
	public function setOrderStatus($orderStatus);

	/**
	 * OrderStatusReason
	 *
	 * @return  string
	 */
	public function getOrderStatusReason();

	/**
	 * @param   string
	 * @return  self
	 *
	 */
	public function setOrderStatusReason($orderStatusReason);

	/**
	 * LineDetails
	 * @return Radial_RiskService_Sdk_Line_IDetails
	 *
	 */
	public function getLineDetails();

	/**
	 * @param   Radial_RiskService_Sdk_Line_IDetails
	 * @return  self
	 *
	 */
	public function setLineDetails(Radial_RiskService_Sdk_Line_IDetails $lineDetails);

	/**
	 * CustomAttributesList
	 * @return Radial_RiskService_Sdk_ICustomAttributesList
	 *
	 */
	public function getCustomAttributesList();

	/**
	 * @param   Radial_RiskService_Sdk_CustomAttributes_IList
	 * @return  self
	 *
	 */
	public function setCustomAttributesList(Radial_RiskService_Sdk_CustomAttributes_IList $customAttributesList);
}
