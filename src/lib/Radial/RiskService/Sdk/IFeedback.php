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

interface Radial_RiskService_Sdk_IFeedback extends Radial_RiskService_Sdk_Payload_ITop
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
