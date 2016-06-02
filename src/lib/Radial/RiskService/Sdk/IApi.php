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

interface Radial_RiskService_Sdk_IApi
{
	/**
	 * Get the request payload object.
	 * Initially, create and return a new empty payload
	 * of the type of payload for the configured service.
	 * (Users should not rely on the mutability of the returned object;
	 * Use `setRequestBody` to ensure a payload is attached for sending.)
	 *
	 * @return Radial_RiskService_Sdk_IPayload
	 */
	public function getRequestBody();

	/**
	 * Set the payload for the configured request.
	 * This is the only way to guarantee an api has
	 * a payload to send.
	 *
	 * @param  Radial_RiskService_Sdk_IPayload
	 * @return self
	 */
	public function setRequestBody(Radial_RiskService_Sdk_IPayload $payload);

	/**
	 * Send the request.
	 * May validate the payload before sending.
	 *
	 * @throws Radial_RiskService_Sdk_Exception_Invalid_Payload_Exception
	 * @return self
	 */
	public function send();

	/**
	 * Retrieve the response payload.
	 * May validate the payload before delivering.
	 *
	 * @return Radial_RiskService_Sdk_IPayload
	 */
	public function getResponseBody();
}
