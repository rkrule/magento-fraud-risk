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

abstract class Radial_RiskService_Sdk_Payload
	implements Radial_RiskService_Sdk_IPayload
{
	/** @var Radial_RiskService_Sdk_Xsd_Validator */
	protected $_schemaValidator;
	/** @var Radial_RiskService_Sdk_Helper */
	protected $_helper;
	/** @var array $_extractionPaths - XPath expressions to extract required data from the serialized payload (XML) */
	protected $_extractionPaths = array();
	/** @var array */
	protected $_optionalExtractionPaths = array();
	/** @var array */
	protected $_dateTimeExtractionPaths = array();
	/** @var array $_booleanExtractionPaths - property/XPath pairs that take boolean values */
	protected $_booleanExtractionPaths = array();
	/**
	 * @var array $_subpayloadExtractionPaths - property/XPath pairs. if property is a payload, first node matched
	 *            will be deserialized by that payload
	 */
	protected $_subpayloadExtractionPaths = array();

	/**
	 * @param array $initParams Must have this key:
	 *                          - 'helper' => Radial_RiskService_Sdk_Helper
	 */
	public function __construct(array $initParams=array())
	{
		$this->_helper = $this->_checkHelperClassType(
			$this->_nullCoalesce($initParams, 'helper', $this->_getNewInstance('Radial_RiskService_Sdk_Helper'))
		);
	}

	/**
	 * Type hinting for self::__construct $initParams
	 *
	 * @param  Radial_RiskService_Sdk_Helper
	 * @return Radial_RiskService_Sdk_Helper
	 */
	protected function _checkHelperClassType(Radial_RiskService_Sdk_Helper $helper)
	{
		return $helper;
	}

	/**
	 * Create new instance.
	 *
	 * @param  string
	 * @param  mixed
	 * @return mixed
	 */
	protected function _getNewInstance($class, $arguments=array())
	{
		return new $class($arguments);
	}

	/**
	 * Return the value at field in array if it exists. Otherwise, use the default value.
	 *
	 * @param  array
	 * @param  string | int $field Valid array key
	 * @param  mixed
	 * @return mixed
	 */
	protected function _nullCoalesce(array $arr, $field, $default)
	{
		return isset($arr[$field]) ? $arr[$field] : $default;
	}

	/**
	 * Fill out this payload object with data from the supplied string.
	 *
	 * @throws Radial_RiskService_Sdk_Exception_Invalid_Payload_Exception
	 * @param  string
	 * @return $this
	 */
	public function deserialize($serializedPayload)
	{
		$xpath = $this->_helper->getPayloadAsXPath($serializedPayload, $this->_getXmlNamespace());
		$this->_deserializeExtractionPaths($xpath)
			->_deserializeOptionalExtractionPaths($xpath)
			->_deserializeBooleanExtractionPaths($xpath)
			->_deserializeLineItems($serializedPayload)
			->_deserializeSubpayloadExtractionPaths($xpath)
			->_deserializeDateTimeExtractionPaths($xpath)
			->_deserializeExtra($serializedPayload);
		return $this;
	}

	/**
	 * @param  DOMXPath
	 * @return self
	 */
	protected function _deserializeExtractionPaths(DOMXPath $xpath)
	{
		foreach ($this->_extractionPaths as $setter => $path) {
			$this->$setter($xpath->evaluate($path));
		}
		return $this;
	}

	/**
	 * When optional nodes are not included in the serialized data,
	 * they should not be set in the payload. Fortunately, these
	 * are all string values so no additional type conversion is necessary.
	 *
	 * @param  DOMXPath
	 * @return self
	 */
	protected function _deserializeOptionalExtractionPaths(DOMXPath $xpath)
	{
		foreach ($this->_optionalExtractionPaths as $setter => $path) {
			$foundNode = $xpath->query($path)->item(0);
			if ($foundNode) {
				$this->$setter($foundNode->nodeValue);
			}
		}
		return $this;
	}

	/**
	 * boolean values have to be handled specially
	 *
	 * @param  DOMXPath
	 * @return self
	 */
	protected function _deserializeBooleanExtractionPaths(DOMXPath $xpath)
	{
		foreach ($this->_booleanExtractionPaths as $setter => $path) {
			$value = $xpath->evaluate($path);
			$this->$setter($this->_helper->convertStringToBoolean($value));
		}
		return $this;
	}

	/**
	 * @param  DOMXPath
	 * @return self
	 */
	protected function _deserializeSubpayloadExtractionPaths(DOMXPath $xpath)
	{
		foreach ($this->_subpayloadExtractionPaths as $setter => $path) {
			$foundNode = $xpath->query($path)->item(0);
			$getter = 'g' . substr($setter, 1);
			if ($foundNode && $this->$getter() instanceof Radial_RiskService_Sdk_IPayload) {
				$this->$getter()->deserialize($foundNode->C14N());
			}
		}
		return $this;
	}

	/**
	 * Ensure any date time string is instantiate
	 *
	 * @param  DOMXPath
	 * @return self
	 */
	protected function _deserializeDateTimeExtractionPaths(DOMXPath $xpath)
	{
		foreach ($this->_dateTimeExtractionPaths as $setter => $path) {
			$value = $xpath->evaluate($path);
			if ($value) {
				$this->$setter(new DateTime($value));
			}
		}
		return $this;
	}

	/**
	 * Return the string form of the payload data for transmission.
	 * Validation is implied.
	 *
	 * @throws Radial_RiskService_Sdk_Exception_Invalid_Payload_Exception
	 * @return string
	 */
	public function serialize()
	{
		$xmlString = sprintf(
			'<%s %s>%s</%1$s>',
			$this->_getRootNodeName(),
			$this->_serializeRootAttributes(),
			$this->_serializeContents()
		);
		$canonicalXml = $this->_helper->getPayloadAsDoc($xmlString)->C14N();
		return $this->_canSerialize() ? $canonicalXml : '';
	}

	/**
	 * Determine if a subpayload node is serializable.
	 *
	 * @return bool
	 */
	protected function _canSerialize()
	{
		return true;
	}

	/**
	 * Stash the xsd validator in the class property '_schemaValidator'
	 *
	 * @return Radial_RiskService_Sdk_Xsd_Validator
	 */
	protected function _getXsdValidator()
	{
		if (!$this->_schemaValidator) {
			$this->_schemaValidator = $this->_buildPayloadForModel('Radial_RiskService_Sdk_Xsd_Validator');
		}
		return $this->_schemaValidator;
	}

	/**
	 * Additional deserialization of the payload data. May contain any
	 * special case deserialization that cannot be expressed by the supported
	 * deserialization paths. Default implementation is a no-op. Expected to
	 * be overridden by payloads that need it.
	 *
	 * @param  string
	 * @return self
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
	 */
	protected function _deserializeExtra($serializedPayload)
	{
		return $this;
	}

	/**
	 * convert line item substrings into line item objects
	 *
	 * @param  string
	 * @return self
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
	 */
	protected function _deserializeLineItems($serializedPayload)
	{
		return $this;
	}

	/**
	 * Build a new Radial_RiskService_Sdk_IPayload for the given interface.
	 *
	 * @param  strings
	 * @return Radial_RiskService_Sdk_IPayload
	 */
	protected function _buildPayloadForModel($model)
	{
		return new $model();
	}

	/**
	 * Return the name of the xml root node.
	 *
	 * @return string
	 */
	abstract protected function _getRootNodeName();

	/**
	 * Serialize Root Attributes
	 *
	 * @return string
	 */
	protected function _serializeRootAttributes()
	{
		$rootAttributes = $this->_getRootAttributes();
		$qualifyAttributes = function ($name) use ($rootAttributes) {
			return sprintf('%s="%s"', $name, $rootAttributes[$name]);
		};
		$qualifiedAttributes = array_map($qualifyAttributes, array_keys($rootAttributes));
		return implode(' ', $qualifiedAttributes);
	}

	/**
	 * XML Namespace of the document.
	 *
	 * @return string
	 */
	abstract protected function _getXmlNamespace();

	/**
	 * Name, value pairs of root attributes
	 *
	 * @return array
	 */
	protected function _getRootAttributes()
	{
		return array();
	}

	/**
	 * Serialize the various parts of the payload into XML strings and concatenate them together.
	 *
	 * @return string
	 */
	abstract protected function _serializeContents();

	/**
	 * Serialize the value as an xml element with the given node name.
	 *
	 * @param  string
	 * @param  mixed
	 * @return string
	 */
	protected function _serializeNode($nodeName, $value)
	{
		return sprintf('<%s>%s</%1$s>', $nodeName, $this->xmlEncode($this->_helper->escapeHtml($value)));
	}

	/**
         * Serialize the boolean value as an xml element with the given node name.
         *
         * @param  string
         * @param  mixed
         * @return string
         */
	protected function _serializeBooleanNode($nodeName, $value)
	{
		if(!$this->_helper->convertStringToBoolean($value))
		{
			return sprintf('<%s>0</%1$s>', $nodeName);
		} else {
			return sprintf('<%s>%s</%1$s>', $nodeName, $this->_helper->convertStringToBoolean($value));
		}
	}

	protected function _serializeAmountNode($nodeName, $amount, $currencyCode)
	{
		if( $currencyCode)
		{
			return "<$nodeName currencyCode=\"$currencyCode\">{$this->_helper->formatAmount($amount)}</$nodeName>";
		} else {
			return "<$nodeName>{$this->_helper->formatAmount($amount)}</$nodeName>";
		}
	}

	/**
	 * Serialize the value as an xml element with the given node name. When
	 * given an empty value, returns an empty string instead of an empty
	 * element.
	 *
	 * @param  string
	 * @param  mixed
	 * @return string
	 */
	protected function _serializeOptionalValue($nodeName, $value)
	{
		return (!is_null($value) && $value !== '') ? $this->_serializeNode($nodeName, $value) : '';
	}

	/**
	 * Serialize the currency amount as an XML node with the provided name.
	 * When the amount is not set, returns an empty string.
	 *
	 * @param  string
	 * @param  float
	 * @param  string
	 * @return string
	 */
	protected function _serializeOptionalAmount($nodeName, $amount, $currencyCode=null)
	{
		if( $currencyCode)
		{
			return (!is_null($amount) && !is_nan($amount)) ? "<$nodeName currencyCode=\"$currencyCode\">{$this->_helper->formatAmount($amount)}</$nodeName>" : '';
		} else {
			return (!is_null($amount) && !is_nan($amount)) ? "<$nodeName>{$this->_helper->formatAmount($amount)}</$nodeName>" : '';
		}
	}

	protected function _serializeOptionalNumber($nodeName, $number)
	{
		return (!is_null($number) && !is_nan($number)) ? "<$nodeName>{$number}</$nodeName>" : '';
	}

	/**
	 * Serialize an optional date time value. When a DateTime value is given,
	 * serialize the DateTime object as an XML node containing the DateTime
	 * formatted with the given format. When no DateTime is given, return
	 * an empty string.
	 *
	 * @param  string
	 * @param  string
	 * @param  DateTime
	 * @return string
	 */
	protected function _serializeOptionalDateValue($nodeName, $format, DateTime $date = null)
	{
		return $date ? "<$nodeName>{$date->format($format)}</$nodeName>" : '';
	}

       /**
     	* encode the passed in string to be safe for xml if it is not null,
     	* otherwise simply return the null parameter.
     	*
     	* @param string|null
     	* @return string|null
     	*/
    	protected function xmlEncode($value = null)
    	{
    	    return !is_null($value) ? htmlentities($value, ENT_XML1) : $value;
    	}
}
