<?php
/* Copyright (c) 2015 Radial, Inc.
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

class Radial_RiskService_Sdk_ExternalRiskResult
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_IExternalRiskResult
{
	/** @var string */
	protected $_score;
	/** @var string */
	protected $_code;
	/** @var string */
	protected $_source;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->_optionalExtractionPaths = array(
			'setScore' => 'x:Score',
			'setCode'  => 'x:Code',
			'setSource' => 'x:Source',
		);
	}

	/**
	 * @see Radial_RiskService_Sdk_IExternalRiskResult::getScore()
	 */
	public function getScore()
	{
		return $this->_score;
	}

	/**
	 * @see Radial_RiskService_Sdk_IExternalRiskResult::setScore()
	 */
	public function setScore($score)
	{
		$this->_score = $score;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_IExternalRiskResult::getCode()
         */
        public function getCode()
        {
                return $this->_code;
        }
 
        /**
         * @see Radial_RiskService_Sdk_IExternalRiskResult::setCode()
         */
        public function setCode($code)
        {
                $this->_code = $code;
                return $this;
        }

	/**
         * @see Radial_RiskService_Sdk_IExternalRiskResult::getSource()
         */
        public function getSource()
        {
                return $this->_source;
        }
 
        /**
         * @see Radial_RiskService_Sdk_IExternalRiskResult::setSource()
         */
        public function setSource($source)
        {
                $this->_source = $source;
                return $this;
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
		return $this->_serializeOptionalValue('Score', $this->getScore())
			. $this->_serializeOptionalValue('Code', $this->getCode())
			. $this->_serializeOptionalValue('Source', $this->getSource());
	}
}
