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
 * http://www.radial.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf
 *
 * @copyright   Copyright (c) 2015 eBay Enterprise, Inc. (http://www.radial.com/)
 * @license     http://www.radial.com/files/pdf/Magento_Connect_Extensions_EULA_050714.pdf  eBay Enterprise Magento Extensions End User License Agreement
 *
 */

interface EbayEnterprise_Eb2cFraud_Model_Build_IOCRequest
{
    const RESPONSE_TYPE = 'avs';
    const DEFAULT_SHIPPING_METHOD ='Unknown';
    const PHYSICAL_SHIPMENT_TYPE = 'physical';
    const VIRTUAL_SHIPMENT_TYPE = 'virtual';
    const VIRTUAL_SHIPPING_METHOD = 'EMAIL';

    /**
     * Build the Risk Service request payload.
     *
     * @return EbayEnterprise_Eb2cFraud_Sdk_IPayload
     */
    public function build();
}
