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

abstract class Radial_RiskService_Sdk_Iterable
	extends SPLObjectStorage
	implements Radial_RiskService_Sdk_IIterable
{
	/** @var Radial_RiskService_Sdk_Helper */
	protected $_helper;
	/** @var bool */
	protected $_includeIfEmpty = false;
	/** @var bool */
	protected $_buildRootNode = true;

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
	 * @see Radial_RiskService_Sdk_IPayload::serialize()
	 */
	public function serialize()
	{
		$format = $this->_buildRootNode ? '<%1$s>%2$s</%1$s>' : '%2$s';
		$serializedSubpayloads = $this->_serializeContents();
		return ($this->_includeIfEmpty || $serializedSubpayloads)
			? sprintf($format, $this->_getRootNodeName(), $serializedSubpayloads)
			: '';
	}

	/**
	 * @see Radial_RiskService_Sdk_IPayload::deserialize()
	 */
	public function deserialize($serializedData)
	{
		$xpath = $this->_helper->getPayloadAsXPath($serializedData, $this->_getXmlNamespace());
		foreach ($xpath->query($this->_getSubpayloadXPath()) as $subpayloadNode) {
			$pl = $this->_getNewSubpayload()->deserialize($subpayloadNode->C14N());
			$this->offsetSet($pl);
		}
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_Payload::_serializeContents()
	 */
	protected function _serializeContents()
	{
		$serializedSubpayloads = '';
		foreach ($this as $subpayload) {
			$serializedSubpayloads .= $subpayload->serialize();
		}
		return $serializedSubpayloads;
	}

	/**
	 * Get an XPath expression that will separate the serialized data into
	 * XML for each subpayload in the iterable.
	 *
	 * @return string
	 */
	abstract protected function _getSubpayloadXPath();

	/**
	 * Return an instance of the new subpayload to be deserialized or serialized.
	 *
	 * @return Radial_RiskService_Sdk_IPayload
	 */
	abstract protected function _getNewSubpayload();

	/**
	 * Build a new IPayload for the given interface.
	 *
	 * @param  string
	 * @return Radial_RiskService_Sdk_IPayload
	 */
	protected function _buildPayloadForModel($model)
	{
		return new $model();
	}

	/**
	 * XML Namespace of the document.
	 *
	 * @return string
	 */
	abstract protected function _getXmlNamespace();

	/**
	 * Return the name of the xml root node.
	 *
	 * @return string
	 */
	abstract protected function _getRootNodeName();
}
