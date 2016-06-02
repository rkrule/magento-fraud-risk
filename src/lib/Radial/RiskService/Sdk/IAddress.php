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

interface Radial_RiskService_Sdk_IAddress extends Radial_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'Address';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

	/**
	 * xsd restrictions: 1-100 characters
	 * @return string
	 */
	public function getLineA();

	/**
	 * @param  string
	 * @return self
	 */
	public function setLineA($lineA);

	/**
	 * @return string
	 */
	public function getLineB();

	/**
	 * @param  string
	 * @return self
	 */
	public function setLineB($lineB);

	/**
	 * @return string
	 */
	public function getLineC();

	/**
	 * @param  string
	 * @return self
	 */
	public function setLineC($lineC);

	/**
	 * @return string
	 */
	public function getLineD();

	/**
	 * @param  string
	 * @return self
	 */
	public function setLineD($lineD);

	/**
	 * @return string
	 */
	public function getCity();

	/**
	 * @param  string
	 * @return self
	 */
	public function setCity($city);

	/**
	 * @return string
	 */
	public function getPostalCode();

	/**
	 * @param  string
	 * @return self
	 */
	public function setPostalCode($postalCode);

	/**
	 * @return string
	 */
	public function getMainDivision();

	/**
	 * @param  string
	 * @return self
	 */
	public function setMainDivision($mainDivision);

	/**
	 * @return string
	 */
	public function getCountryCode();

	/**
	 * @param  string
	 * @return self
	 */
	public function setCountryCode($countryCode);

        /**
         * @return string
         */
        public function getAddressID();

        /**
         * @param  string
         * @return self
         */
        public function setAddressID($addressID);
}
