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

interface EbayEnterprise_RiskService_Sdk_IShipment extends EbayEnterprise_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'Shipment';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';
	const COST_TOTALS_MODEL ='EbayEnterprise_RiskService_Sdk_Cost_Totals';

	/**
	 * @return string
	 */
	public function getShipmentId();

	/**
	 * @param  string
	 * @return self
	 */
	public function setShipmentId($shipmentId);

        /**
         * @return string
         */
        public function getAddressId();

        /**
         * @param  string
         * @return self
         */
        public function setAddressId($addressId);

	/**
	 * The method of shipment for the order.
	 * Sample Data: Standard_Ground,1DAY,2DAY,EXPRESS
	 *
	 * xsd restrictions: >= 1 characters
	 * @return string
	 */
	public function getShippingMethod();

	/**
	 * @param  string
	 * @return self
	 */
	public function setShippingMethod($shippingMethod);

	/**
	 * Contains the total cost details regarding currency used, before tax amount, and after tax amount.
	 *
	 * @return EbayEnterprise_RiskService_Sdk_Cost_ITotals
	 */
	public function getCostTotals();

	/**
	 * @param  EbayEnterprise_RiskService_Sdk_Cost_ITotals
	 * @return self
	 */
	public function setCostTotals(EbayEnterprise_RiskService_Sdk_Cost_ITotals $costTotals);
}
