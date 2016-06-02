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

interface Radial_RiskService_Sdk_IExternalRiskResult extends Radial_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'ExternalRiskResult';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

	/**
	 * @return string
	 */
	public function getScore();

	/**
	 * @param  string
	 * @return self
	 */
	public function setScore($score);

	/**
	 * @return string
	 */
	public function getCode();

	/**
	 * @param  string 
	 * @return self
	 */
	public function setCode($code);

	/**
         * @return string
         */
        public function getSource();

        /**
         * @param  string
         * @return self
         */
        public function setSource($source);
}
