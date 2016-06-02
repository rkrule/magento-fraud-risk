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

class Radial_RiskService_Sdk_Http_Headers
	extends Radial_RiskService_Sdk_Iterable
	implements Radial_RiskService_Sdk_Http_IHeaders
{
	/**
	 * Get an empty instance of the http header payload
	 *
	 * @return Radial_RiskService_Sdk_Http_IHeader
	 */
	public function getEmptyHttpHeader()
	{
		return $this->_buildPayloadForModel(static::HTTP_HEADER_MODEL);
	}

	/**
	 * @see Radial_RiskService_Sdk_Iterable::_getNewSubpayload()
	 */
	protected function _getNewSubpayload()
	{
		return $this->getEmptyHttpHeader();
	}

	/**
	 * @see Radial_RiskService_Sdk_Iterable::_getSubpayloadXPath()
	 */
	protected function _getSubpayloadXPath()
	{
		return 'x:' . static::SUBPAYLOAD_XPATH;
	}

	/**
	 * @see Radial_RiskService_Sdk_Iterable::_getRootNodeName()
	 */
	protected function _getRootNodeName()
	{
		return static::ROOT_NODE;
	}

	/**
	 * @see Radial_RiskService_Sdk_Iterable::_getXmlNamespace()
	 */
	protected function _getXmlNamespace()
	{
		return self::XML_NS;
	}
}
