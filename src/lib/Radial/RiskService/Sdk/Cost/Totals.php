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

class Radial_RiskService_Sdk_Cost_Totals
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_Cost_ITotals
{
	/** @var string */
	protected $_currencyCode;
	/** @var float */
	protected $_amountBeforeTax;
	/** @var float */
	protected $_amountAfterTax;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_extractionPaths = array(
			'setAmountBeforeTax' => 'number(x:AmountBeforeTax)',
			'setCurrencyCode' => 'string(x:AmountBeforeTax/@currencyCode)',
		);
		$this->_optionalExtractionPaths = array(
			'setAmountAfterTax' => 'x:AmountAfterTax',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_Cost_ITotals::getAmountBeforeTax()
	 */
	public function getAmountBeforeTax()
	{
		return $this->_amountBeforeTax;
	}

	/**
	 * @see Radial_RiskService_Sdk_Cost_ITotals::setAmountBeforeTax()
	 */
	public function setAmountBeforeTax($amountBeforeTax)
	{
		$this->_amountBeforeTax = $amountBeforeTax;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Cost_ITotals::getAmountAfterTax()
	 */
	public function getAmountAfterTax()
	{
		return $this->_amountAfterTax;
	}

	/**
	 * @see Radial_RiskService_Sdk_Cost_ITotals::setAmountAfterTax()
	 */
	public function setAmountAfterTax($amountAfterTax)
	{
		$this->_amountAfterTax = $amountAfterTax;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Cost_ITotals::getCurrencyCode()
	 */
	public function getCurrencyCode()
	{
		return $this->_currencyCode;
	}

	/**
	 * @see Radial_RiskService_Sdk_Cost_ITotals::setCurrencyCode()
	 */
	public function setCurrencyCode($currencyCode)
	{
		$this->_currencyCode = $currencyCode;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_canSerialize()
	 */
	protected function _canSerialize()
	{
		return (trim($this->getAmountBeforeTax()) !== '');
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getRootNodeName()
	 */
	protected function _getRootNodeName()
	{
		return static::ROOT_NODE;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_getXmlNamespace()
	 */
	protected function _getXmlNamespace()
	{
		return self::XML_NS;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_serializeContents()
	 */
	protected function _serializeContents()
	{
		return $this->_serializeAmountNode('AmountBeforeTax', $this->getAmountBeforeTax(), $this->_currencyCode)
			. $this->_serializeOptionalAmount('AmountAfterTax', $this->getAmountAfterTax(), $this->_currencyCode);
	}
}
