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

/**
 * @codeCoverageIgnore
 */
class EbayEnterprise_Eb2cFraud_Helper_Config
{
	const ENABLED = 'eb2ccore/fraud/enabledmod';
	const STORE_ID = 'eb2ccore/general/store_id';
	const API_HOSTNAME = 'eb2ccore/api/hostname';
	const API_KEY = 'eb2ccore/api/key';
	const API_TIMEOUT = 'eb2ccore/api/timeout';
	const DEBUG = 'eb2ccore/fraud/debug';
	const LANGUAGE_CODE = 'eb2ccore/general/language_code';
        const CARD_TYPE_MAP = 'eb2cfraud/risk_service/card_type_map';
	const CARD_NAME_MAP = 'eb2cfraud/risk_service/card_name_map';
        const SHIPPING_METHOD_MAP = 'eb2cfraud/risk_service/shipping_method_map';
        const PAYMENT_ADAPTER_MAP = 'eb2cfraud/risk_service/payment_adapter_map';
	const UOM = 'eb2cfraud/risk_service/uom';

	/**
	 * check if Risk Insight module is enable in the store config
	 *
	 * @param  mixed
	 * @return bool
	 */
	public function isEnabled($store=null)
	{
		return Mage::getStoreConfigFlag(static::ENABLED, $store);
	}

	/**
	 * check if debug mode is enable in the store config
	 *
	 * @param  mixed
	 * @return bool
	 */
	public function isDebugMode($store=null)
	{
		return Mage::getStoreConfigFlag(static::DEBUG, $store);
	}

	/**
	 * retrieve the FraudNet Store id from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getStoreId($store=null)
	{
		return Mage::getStoreConfig(static::STORE_ID, $store);
	}

	/**
	 * retrieve the language code from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getLanguageCodeId($store=null)
	{
		return Mage::getStoreConfig(static::LANGUAGE_CODE, $store);
	}

	/**
	 * retrieve the API Host Name from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getApiHostname($store=null)
	{
		return Mage::getStoreConfig(static::API_HOSTNAME, $store);
	}

	/**
	 * retrieve the API encrypted key from store config and decrypt it.
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getApiKey($store=null)
	{
		return Mage::getStoreConfig(static::API_KEY, $store);
	}

	/**
	 * retrieve the API timeout setting from store config
	 *
	 * @param  mixed
	 * @return string
	 */
	public function getApiTimeout($store=null)
	{
		return Mage::getStoreConfig(static::API_TIMEOUT, $store);
	}


    /**
     * retrieve the payment method card type map settings from store config
     *
     * @param  mixed
     * @return string
     */
    public function getPaymentMethodCardTypeMap($store=null)
    {
        return Mage::getStoreConfig(static::CARD_TYPE_MAP, $store);
    }

    /**
     * retrieve the payment method card type name settings from store config
     *
     * @param  mixed
     * @return string
     */
    public function getPaymentMethodCardNameMap($store=null)
    {
        return Mage::getStoreConfig(static::CARD_NAME_MAP, $store);
    }

    /**
     * retrieve the shipping method map settings from store config
     *
     * @param  mixed
     * @return string
     */
    public function getShippingMethodMap($store=null)
    {
        return Mage::getStoreConfig(static::SHIPPING_METHOD_MAP, $store);
    }

    /**
     * retrieve the payment adapter map settings from store config
     *
     * @param  mixed
     * @return string
     */
    public function getPaymentAdapterMap($store=null)
    {
        return Mage::getStoreConfig(static::PAYMENT_ADAPTER_MAP, $store);
    }

    /**
     * retrieve the unit of measure for the store
     *
     * @param  mixed
     * @return string
     */
    public function getUnitOfMeasure($store=null)
    {
	return Mage::getStoreConfig(static::UOM, $store);
    }

    /**
     * Get the ROM Tender Type for the Magento CC Type.
     * @param  string $creditCardType
     * @return string
     */
    public function getTenderTypeForCcType($creditCardType)
    {
        $types = $this->getPaymentMethodCardTypeMap();
        if (isset($types[$creditCardType])) {
            return $types[$creditCardType];
        }
        throw Mage::exception('EbayEnterprise_CreditCard', self::UNKNOWN_CARD_TYPE);
    }

    /**
     * Get the Name for the Magento CC Type.
     * @param  string $creditCardType
     * @return string
     */
    public function getTenderNameForCcType($creditCardType)
    {
        $types = $this->getPaymentMethodCardNameMap();
        if (isset($types[$creditCardType])) {
            return $types[$creditCardType];
        }
    }
}

