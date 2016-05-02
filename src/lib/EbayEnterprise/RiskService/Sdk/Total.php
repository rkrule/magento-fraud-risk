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

class EbayEnterprise_RiskService_Sdk_Total
	extends EbayEnterprise_RiskService_Sdk_Payload
	implements EbayEnterprise_RiskService_Sdk_ITotal
{
	/** @var EbayEnterprise_RiskService_Sdk_Cost_Totals */
	protected $_costTotals;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setCostTotals($this->_buildPayloadForModel(static::COST_TOTALS_MODEL));
		$this->_subpayloadExtractionPaths = array(
			'setCostTotals' => 'x:CostTotals',
		);
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_ITotal::getCostTotals()
	 */
	public function getCostTotals()
	{
		return $this->_costTotals;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_ITotal::setCostTotals()
	 */
	public function setCostTotals(EbayEnterprise_RiskService_Sdk_Cost_ITotals $costTotals)
	{
		$this->_costTotals = $costTotals;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_canSerialize()
	 */
	protected function _canSerialize()
	{
		return (trim($this->getCostTotals()->serialize()) !== '');
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_getRootNodeName()
	 */
	protected function _getRootNodeName()
	{
		return static::ROOT_NODE;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_getXmlNamespace()
	 */
	protected function _getXmlNamespace()
	{
		return self::XML_NS;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::_serializeContents()
	 */
	protected function _serializeContents()
	{
		return $this->getCostTotals()->serialize();
	}
}
