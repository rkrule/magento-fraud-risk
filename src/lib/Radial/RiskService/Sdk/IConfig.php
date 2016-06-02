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

interface Radial_RiskService_Sdk_IConfig
{
	/**
	 * @return Radial_RiskService_Sdk_IPayload
	 */
	public function getRequest();

	/**
	 * @param  Radial_RiskService_Sdk_IPayload
	 * @return self
	 */
	public function setRequest(Radial_RiskService_Sdk_IPayload $request);

	/**
	 * @return Radial_RiskService_Sdk_IPayload
	 */
	public function getResponse();

	/**
	 * @param  Radial_RiskService_Sdk_IPayload
	 * @return self
	 */
	public function setResponse(Radial_RiskService_Sdk_IPayload $response);

	/**
	 * @return Radial_RiskService_Sdk_IPayload
	 */
	public function getError();

	/**
	 * @param  Radial_RiskService_Sdk_IPayload
	 * @return self
	 */
	public function setError(Radial_RiskService_Sdk_IPayload $error);
}
