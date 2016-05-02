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

interface EbayEnterprise_RiskService_Model_Risk_IOrder
{
	/**
	 * Get a collection of risk service, send UCP Service Request, base on the response
	 * either change the order status to what is configured from the response code or
	 * simply log message and do nothing.
	 *
	 * @return self
	 */
	public function process();

	/**
	 * @param  EbayEnterprise_RiskService_Model_Risk_Service
	 * @param  Mage_Sales_Model_Order
	 * @return self
	 */
	public function processRiskOrder(EbayEnterprise_RiskService_Model_Risk_Service $service, Mage_Sales_Model_Order $order);
}
