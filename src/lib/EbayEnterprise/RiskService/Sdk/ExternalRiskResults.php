opyright (c) 2015 eBay Enterprise, Inc.
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

class EbayEnterprise_RiskService_Sdk_ExternalRiskResults
	extends EbayEnterprise_RiskService_Sdk_Payload
	implements EbayEnterprise_RiskService_Sdk_IExternalRiskResults
{
	/** @var EbayEnterprise_RiskService_Sdk_ExternalRiskResults */
	protected $_externalRiskResults;
	
	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setExternalRiskResults($this->_buildPayloadForModel(static::EXTERNAL_RISK_RESULT_MODEL));	
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_ExternalRiskResults::getExternalRiskResults()
	 */
	public function getExternalRiskResults()
	{
		return $this->_externalRiskResults;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IExternalRiskResults::setExternalRiskResults()
	 */
	public function setExternalRiskResults(EbayEnterprise_RiskService_Sdk_ExternalRiskResults $externalRiskResults)
	{
		$this->_externalRiskResults = $externalRiskResults;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_Payload::setHttpHeaders()
	 */
	protected function _canSerialize()
	{
		return (trim($this->getExternalRiskResults()->serialize()) !== '');
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
		return $this->getExternalRiskResults()->serialize();
	}
}
