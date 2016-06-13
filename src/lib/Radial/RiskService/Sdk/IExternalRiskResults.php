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

interface Radial_RiskService_Sdk_IExternalRiskResults extends Countable, Iterator, ArrayAccess, Radial_RiskService_Sdk_IIterable
{
	const ROOT_NODE = 'ExternalRiskResults';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';
	const EXTERNAL_RISK_RESULT_MODEL ='Radial_RiskService_Sdk_ExternalRiskResult';	
	const SUBPAYLOAD_XPATH='ExternalRiskResult';

	/**
     	* get an empty shipment
     	*
     	* @return Radial_RiskService_Sdk_IExternalRiskResult
     	*/
     	public function getEmptyExternalRiskResult();
}
