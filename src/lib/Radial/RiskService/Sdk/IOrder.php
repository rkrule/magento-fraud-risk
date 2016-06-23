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

interface Radial_RiskService_Sdk_IOrder extends Radial_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'Order';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';
	const SHIPPING_LIST_MODEL ='Radial_RiskService_Sdk_Shipping_List';
	const LINE_ITEMS_MODEL ='Radial_RiskService_Sdk_Line_Items';
	const PAYMENTS_MODEL ='Radial_RiskService_Sdk_Payments';
	const TOTAL_MODEL ='Radial_RiskService_Sdk_Total';
        const SHOPPING_SESSION_MODEL = 'Radial_RiskService_Sdk_ShoppingSession';
        const CUSTOMER_LIST_MODEL = 'Radial_RiskService_Sdk_Customer_List';
	const EXTERNAL_RISK_RESULTS_MODEL = 'Radial_RiskService_Sdk_ExternalRiskResults';

	/**
	 * Unique identifier of the order in the web site.
	 *
	 * xsd restrictions: 1-40 characters
	 * @return string
	 */
	public function getOrderId();

	/**
	 * @param  string
	 * @return self
	 */
	public function setOrderId($orderId);

    /**
     * Unique identifier of the order in the web site.
     *
     * xsd restrictions: 1-40 characters
     * @return string
     */
    public function getPromoCode();

    /**
     * @param  string
     * @return self
     */
    public function setPromoCode($promoCode);

    /**
     * @return Radial_RiskService_Sdk_Customer_IList
     */
    public function getCustomerList();

    /**
     * @param  Radial_RiskService_Sdk_Customer_IList
     * @return self
     */
    public function setCustomerList(Radial_RiskService_Sdk_Customer_IList $customerList);

    /**
     * @return Radial_RiskService_Sdk_IExternalRiskResults
     */
    public function getExternalRiskResults();

    /**
     * @param  Radial_RiskService_Sdk_IExternalRiskResults
     * @return self
     */
    public function setExternalRiskResults(Radial_RiskService_Sdk_IExternalRiskResults $externalRiskResults);

	/**
	 * @return Radial_RiskService_Sdk_Shipping_IList
	 */
	public function getShippingList();

	/**
	 * @param  Radial_RiskService_Sdk_Shipping_IList
	 * @return self
	 */
	public function setShippingList(Radial_RiskService_Sdk_Shipping_IList $shippingList);

	/**
	 * @return Radial_RiskService_Sdk_Line_IItems
	 */
	public function getLineItems();

	/**
	 * @param  Radial_RiskService_Sdk_Line_IItems
	 * @return self
	 */
	public function setLineItems(Radial_RiskService_Sdk_Line_IItems $lineItems);

    /**
     * @return Radial_RiskService_Sdk_IShoppingSession
     */
    public function getShoppingSession();

    /**
     * @param  Radial_RiskService_Sdk_IShoppingSession
     * @return self
     */
    public function setShoppingSession(Radial_RiskService_Sdk_IShoppingSession $shoppingSession);

	/**
	 * @return Radial_RiskService_Sdk_ITotal
	 */
	public function getTotalCost();

	/**
	 * @param  Radial_RiskService_Sdk_ITotal
	 * @return self
	 */
	public function setTotalCost(Radial_RiskService_Sdk_ITotal $totalCost);
}
