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

class Radial_RiskService_Sdk_Total
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_ITotal
{
	/** @var Radial_RiskService_Sdk_Cost_Totals */
	protected $_costTotals;
	/** @var Radial_RiskInsight_Sdk_Payment */
	protected $_formOfPayment;
        protected $_failedCc;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setCostTotals($this->_buildPayloadForModel(static::COST_TOTALS_MODEL));
        	$this->setFormOfPayment($this->_buildPayloadForModel(static::PAYMENTS_MODEL));
		$this->_subpayloadExtractionPaths = array(
			'setCostTotals' => 'x:CostTotals',
			'setFormOfPayment' => 'x:FormOfPayment',
		);
        	$this->_optionalExtractionPaths = array(
        	    	'setFailedCc' => 'x:FailedCc/@number',
        	);
	}

	/**
	 * @see Radial_RiskService_Sdk_ITotal::getCostTotals()
	 */
	public function getCostTotals()
	{
		return $this->_costTotals;
	}

	/**
	 * @see Radial_RiskService_Sdk_ITotal::setCostTotals()
	 */
	public function setCostTotals(Radial_RiskService_Sdk_Cost_ITotals $costTotals)
	{
		$this->_costTotals = $costTotals;
		return $this;
	}

    /**
     * @see Radial_RiskService_Sdk_IOrder::getFormOfPayment()
     */
    public function getFormOfPayment()
    {
        return $this->_formOfPayment;
    }

    /**
     * @see Radial_RiskService_Sdk_IOrder::setFormOfPayment()
     */
    public function setFormOfPayment(Radial_RiskService_Sdk_IPayment $formOfPayment)
    {
        $this->_formOfPayment = $formOfPayment;
        return $this;
    }

    /**
     * Failed CC Attempts in 1 Session Before Success
     *
     * @return string
     */
    public function getFailedCc()
    {
        return $this->_failedCc;
    }

    /**
     * @param  string
     * @return self
     */
    public function setFailedCc($failedCc)
    {
        $this->_failedCc = $failedCc;
        return $this;
    }

	/**
	 * @see Radial_RiskService_Sdk_Payload::_canSerialize()
	 */
	protected function _canSerialize()
	{
		return (trim($this->getCostTotals()->serialize()) !== '' || trim($this->getFailedCc()) !== '');
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
		return $this->getFormOfPayment()->serialize() 
		. $this->getCostTotals()->serialize()
                . $this->_serializeCcFailed();
	}

	protected function _serializeCcFailed()
	{
                $failedCc = $this->getFailedCc();
                return $failedCc ? "<FailedCc Number=\"${failedCc}\"/>" : '';
	}
}
