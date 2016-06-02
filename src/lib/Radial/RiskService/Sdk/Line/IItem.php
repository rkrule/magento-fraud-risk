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

interface Radial_RiskService_Sdk_Line_IItem extends Radial_RiskService_Sdk_IPayload
{
	const ROOT_NODE = 'LineItem';
	const XML_NS = 'http://api.gsicommerce.com/schema/checkout/1.0';

	/**
	 * @return string
	 */
	public function getLineItemId();

	/**
	 * @param  string
	 * @return self
	 */
	public function setLineItemId($lineItemId);

	/**
	 * @return string
	 */
	public function getShipmentId();

	/**
	 * @param  string
	 * @return self
	 */
	public function setShipmentId($shipmentId);

	/**
         * @return float
	 */
	public function getLineTotalAmount();

        /**
	 * @param  float
	 * @return self
	 */
	public function setLineTotalAmount($lineTotalAmount);

	/**
         * @return float
         */
        public function getUnitCost();

        /**
         * @param  float
         * @return self
         */
        public function setUnitCost($unitCost);

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
        public function getProductName();

        /**
         * @param  string
         * @return self
         */
        public function setProductName($productName);

	/**
         * @return string
         */
        public function getDescription();

        /**
         * @param  string
         * @return self
         */
        public function setDescription($description);

	/**
         * @return float
         */
        public function getUnitWeight();

        /**
         * @param  float
         * @return self
         */
        public function setUnitWeight($unitWeight);

	/**
         * @return string
         */
        public function getCategory();

        /**
         * @param  string
         * @return self
         */
        public function setCategory($category);

	/**
	 * @return string
	 */
	public function getPromoCode();

	/**
	 * @param  string
	 * @return self
	 */
	public function setPromoCode($promoCode);

	 /**
         * @return string
         */
        public function getUnitOfMeasure();

        /**
         * @param  string
         * @return self
         */
        public function setUnitOfMeasure($unitOfMeasure);

	/**
	 * @return string
	 */
	public function getUnitCurrencyCode();

	/**
	 * @param  string
	 * @return self
	 */
	public function setUnitCurrencyCode($unitCurrencyCode);

	/**
         * @return string
         */
        public function getProductId();

        /**
         * @param  string
         * @return self
         */
        public function setProductId($productId);
}
