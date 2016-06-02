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

interface Radial_RiskService_Sdk_Server_IInfo extends Radial_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'ServerInfo';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

	/**
	 * xsd restrictions - datetime format
	 * @return string
	 */
	public function getTime();

	/**
	 * @param  DateTime
	 * @return self
	 */
	public function setTime(DateTime $time);

    /**
     * xsd restrictions - in hours
     * @return string
     */
    public function getTZOffset();

    /**
     * @param  string
     * @return self
     */
    public function setTZOffset($tzOffset);

    /**
     * xsd restrictions - in hours
     * @return string
     */
    public function getTZOffsetRaw();

    /**
     * @param  string
     * @return self
     */
    public function setTZOffsetRaw($tzOffsetRaw);

    /**
     * xsd restrictions - boolean DST Active
     * @return string
     */
    public function getDSTActive();

    /**
     * @param  boolean
     * @return self
     */
    public function setDSTActive($dstActive);
}
