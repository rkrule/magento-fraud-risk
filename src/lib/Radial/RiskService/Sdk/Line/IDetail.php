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

interface Radial_RiskService_Sdk_Line_IDetail extends Radial_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'LineDetail';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

	/**
	 * @return string
	 */
	public function getSKU();

	/**
	 * @param  string
	 * @return self
	 */
	public function setSKU($sku);

	/**
	 * @return int
	 */
	public function getQuantity();

	/**
	 * @param  int
	 * @return self
	 */
	public function setQuantity($quantity);

	/**
         * @return string
	 */
	public function getItemStatus();

        /**
	 * @param  string
	 * @return self
	 */
	public function setItemStatus($itemStatus);

	/**
         * @return string
         */
        public function getTrackingNumber();

        /**
         * @param  string
         * @return self
         */
        public function setTrackingNumber($trackingNumber);

	/**
         * @return string
         */
        public function getShippingVendorCode();

        /**
         * @param  string
         * @return self
         */
        public function setShippingVendorCode($shippingVendorCode);

	/**
         * @return string
         */
        public function getDeliveryMethod();

        /**
         * @param  string
         * @return self
         */
        public function setDeliveryMethod($deliveryMethod);

	/**
         * @return string
         */
        public function getShipScheduledDate();

        /**
         * @param  string
         * @return self
         */
        public function setShipScheduledDate(DateTime $shipScheduledDate);

	/**
         * @return string
         */
        public function getShipActualDate();

        /**
         * @param  string
         * @return self
         */
        public function setShipActualDate(DateTime $shipActualDate);
}
