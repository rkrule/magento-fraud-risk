opyright (c) 2015 Radial, Inc.
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

class Radial_RiskService_Sdk_ExternalRiskResults
	extends Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_IExternalRiskResults
{
	/** @var Radial_RiskService_Sdk_ExternalRiskResults */
	protected $_externalRiskResults;
	
	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setExternalRiskResults($this->_buildPayloadForModel(static::EXTERNAL_RISK_RESULT_MODEL));	
	}

	/**
	 * @see Radial_RiskService_Sdk_ExternalRiskResults::getExternalRiskResults()
	 */
	public function getExternalRiskResults()
	{
		return $this->_externalRiskResults;
	}

	/**
	 * @see Radial_RiskService_Sdk_IExternalRiskResults::setExternalRiskResults()
	 */
	public function setExternalRiskResults(Radial_RiskService_Sdk_ExternalRiskResults $externalRiskResults)
	{
		$this->_externalRiskResults = $externalRiskResults;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::setHttpHeaders()
	 */
	protected function _canSerialize()
	{
		return (trim($this->getExternalRiskResults()->serialize()) !== '');
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
		return $this->getExternalRiskResults()->serialize();
	}
}
