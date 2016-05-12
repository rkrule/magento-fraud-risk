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

interface EbayEnterprise_RiskService_Sdk_IFeedback extends EbayEnterprise_RiskService_Sdk_Payload_ITop
{
	const ROOT_NODE = 'RiskServiceFeedback';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';
	const XSD = 'RiskServiceFeedback.xsd';

	/**
	 * The primary language ID used in the XML message.
	 * Sample Data: en-US
	 * Implementation Notes: For future internationalization support.
	 *
	 * value comes from list: {'en'}
	 * @return string
	 */
	public function getPrimaryLangId();

	/**
	 * @param  string
	 * @return self
	 */
	public function setPrimaryLangId($primaryLangId);

	/**
	 * Order number/id. Must be unique across all gsi systems.
	 *
	 * xsd restrictions: >= 1 characters
	 * @return string
	 */
	public function getOrderId();

	/**
	 * @param  string
	 * @return self
	 */
	public function setOrderId($orderId);

	/**
	 * Store code/identifier. Maps to a fraudNet model code in addition to being
	 * sent to fraudNet. New store codes will require configuration both in
	 * risk service and fraudNet
	 *
	 * xsd restrictions: >= 1 characters
	 * @return string
	 */
	public function getStoreId();

	/**
	 * @param  string
	 * @return self
	 */
	public function setStoreId($storeId);

	/**
	 * @return string
	 */
	public function getActionTaken();

	/**
	 * @param  string
	 * @return self
	 */
	public function setActionTaken($actionTaken);

	/**
	 * @return string
	 */
	public function getActionTakenDescription();

	/**
	 * @param  string
	 * @return self
	 */
	public function setActionTakenDescription($actionTakenDescription);

	/**
	 * @return bool
	 */
	public function getChargeBackFlag();

	/**
	 * @param  bool
	 * @return self
	 */
	public function setChargeBackFlag($chargeBackFlag);

	/**
	 * @return string
	 */
	public function getChargeBackFlagDescription();

	/**
	 * @param  string
	 * @return self
	 */
	public function setChargeBackFlagDescription($chargeBackFlagDescription);
}
