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

class Radial_RiskService_Sdk_Payment
	extends Radial_RiskService_Sdk_Info
	implements Radial_RiskService_Sdk_IPayment
{
	/** @var Radial_RiskService_Sdk_Payment_ICard */
	protected $_paymentCard;
	/** @var DateTime */
	protected $_paymentTransactionDate;
	/** @var string */
	protected $_currencyCode;
	/** @var float */
	protected $_amount;
	/** @var int */
	protected $_totalAuthAttemptCount;
	/** @var Radial_RiskService_Sdk_Transaction_IResponses */
	protected $_transactionResponses;
	/** @var Radial_RiskService_Sdk_IAuthorization */
	protected $_authorization;
	/** @var string */
	protected $_paymentTransactionTypeCode;
	/** @var string */
	protected $_tenderClass;
	/** @var string */
	protected $_paymentTransactionID;
	/** @var integer */
	protected $_itemListRPH;
	/** @var string */
	protected $_accountID;
	/** @var bool */
        protected $_isToken;

	public function __construct(array $initParams=array())
	{
		parent::__construct($initParams);
		$this->setPaymentCard($this->_buildPayloadForModel(static::PAYMENT_CARD_MODEL));
		$this->setPersonName($this->_buildPayloadForModel(static::PERSON_NAME_MODEL));
		$this->setTelephone($this->_buildPayloadForModel(static::TELEPHONE_MODEL));
		$this->setAddress($this->_buildPayloadForModel(static::ADDRESS_MODEL));
		$this->setTransactionResponses($this->_buildPayloadForModel(static::TRANSACTION_RESPONSES_MODEL));
		$this->setAuthorization($this->_buildPayloadForModel(static::AUTHORIZATION_MODEL));
		$this->_extractionPaths = array(
			'setEmail' => 'string(x:Email)',
			'setPaymentTransactionTypeCode' => 'string(x:PaymentTransactionTypeCode)',
			'setTenderClass' => 'string(x:TenderClass)',
			'setAmount' => 'number(x:Amount)',
		);
		$this->_optionalExtractionPaths = array(
			'setCurrencyCode' => 'x:Amount/@currencyCode',
			'setPaymentTransactionID' => 'x:PaymentTransactionID',
			'setItemListRPH' =>	'x:ItemListRPH',
			'setAccountID' =>	'x:AccountID',
		);
		$this->_dateTimeExtractionPaths = array(
			'setPaymentTransactionDate' => 'string(x:PaymentTransactionDate)',
		);
		$this->_subpayloadExtractionPaths = array(
			'setPaymentCard' => 'x:PaymentCard',
			'setPersonName' => 'x:PersonName',
			'setTelephone' => 'x:Telephone',
			'setAddress' => 'x:Address',
			'setTransactionResponses' => 'x:TransactionResponses',
			'setAuthorization' => 'x:Authorization',
		);
		$this->_booleanExtractionPaths = array(
                        'setIsToken' => 'string(x:AccountID/@isToken)',
                );

	}

	/**
         * @see Radial_RiskService_Sdk_IPayment::getAccountID()
         */
        public function getAccountID()
        {
                return $this->_accountID;
        }

        /**
         * @see Radial_RiskService_Sdk_IPayment::setAccountID()
         */
        public function setAccountID($accountID)
        {
                $this->_accountID = $accountID;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_IPayment::getPaymentCard()
	 */
	public function getPaymentCard()
	{
		return $this->_paymentCard;
	}

	/**
	 * @see Radial_RiskService_Sdk_IPayment::setPaymentCard()
	 */
	public function setPaymentCard(Radial_RiskService_Sdk_Payment_ICard $paymentCard)
	{
		$this->_paymentCard = $paymentCard;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_IPayment::getAuthorization()
         */
        public function getAuthorization()
        {
                return $this->_authorization;
        }

        /**
         * @see Radial_RiskService_Sdk_IPayment::setAuthorization()
         */
        public function setAuthorization(Radial_RiskService_Sdk_IAuthorization $authorization)
        {
                $this->_authorization = $authorization;
                return $this;
        }

	/**
         * @see Radial_RiskService_Sdk_IPayment::getItemListRPH()
         */
        public function getItemListRPH()
        {
                return $this->_itemListRPH;
        }

        /**
         * @see Radial_RiskService_Sdk_IPayment::setItemListRPH()
         */
        public function setItemListRPH($itemListRPH)
        {
                $this->_itemListRPH = $itemListRPH;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_IPayment::getPaymentTransactionDate()
	 */
	public function getPaymentTransactionDate()
	{
		return $this->_paymentTransactionDate;
	}

	/**
	 * @see Radial_RiskService_Sdk_IPayment::setPaymentTransactionDate()
	 */
	public function setPaymentTransactionDate(DateTime $paymentTransactionDate)
	{
		$this->_paymentTransactionDate = $paymentTransactionDate;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_IPayment::getPaymentTransactionID()
         */
        public function getPaymentTransactionID()
        {
                return $this->_paymentTransactionID;
        }

        /**
         * @see Radial_RiskService_Sdk_IPayment::setPaymentTransactionID()
         */
        public function setPaymentTransactionID($paymentTransactionID)
        {
                $this->_paymentTransactionID = $paymentTransactionID;
                return $this;
        }

	/**
         * @see Radial_RiskService_Sdk_IPayment::getPaymentTransactionTypeCode()
         */
        public function getPaymentTransactionTypeCode()
        {
                return $this->_paymentTransactionTypeCode;
        }

        /**
         * @see Radial_RiskService_Sdk_IPayment::setPaymentTransactionTypeCode()
         */
        public function setPaymentTransactionTypeCode($paymentTransactionTypeCode)
        {
                $this->_paymentTransactionTypeCode = $paymentTransactionTypeCode;
                return $this;
        }

	/**
         * @see Radial_RiskService_Sdk_IPayment::getTenderClass()
         */
        public function getTenderClass()
        {
                return $this->_tenderClass;
        }

        /**
         * @see Radial_RiskService_Sdk_IPayment::setTenderClass()
         */
        public function setTenderClass($tenderClass)
        {
                $this->_tenderClass = $tenderClass;
                return $this;
        }

	/**
	 * @see Radial_RiskService_Sdk_IPayment::getCurrencyCode()
	 */
	public function getCurrencyCode()
	{
		return $this->_currencyCode;
	}

	/**
	 * @see Radial_RiskService_Sdk_IPayment::setCurrencyCode()
	 */
	public function setCurrencyCode($currencyCode)
	{
		$this->_currencyCode = $currencyCode;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_IPayment::getAmount()
	 */
	public function getAmount()
	{
		return $this->_amount;
	}

	/**
	 * @see Radial_RiskService_Sdk_IPayment::setAmount()
	 */
	public function setAmount($amount)
	{
		$this->_amount = $amount;
		return $this;
	}

	/**
	 * @see Radial_RiskService_Sdk_IPayment::getTransactionResponses()
	 */
	public function getTransactionResponses()
	{
		return $this->_transactionResponses;
	}

	/**
	 * @see Radial_RiskService_Sdk_IPayment::setTransactionResponses()
	 */
	public function setTransactionResponses(Radial_RiskService_Sdk_Transaction_IResponses $transactionResponses)
	{
		$this->_transactionResponses = $transactionResponses;
		return $this;
	}

	/**
         * @see Radial_RiskService_Sdk_Payment_ICard::getIsToken()
         */
        public function getIsToken()
        {
                return $this->_isToken;
        }

	/**
         * @see Radial_RiskService_Sdk_Payment_ICard::setIsToken()
         */
        public function setIsToken($isToken)
        {
                $this->_isToken = $isToken;
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
		return $this->getPaymentCard()->serialize()
			. $this->getAuthorization()->serialize()
			. $this->_serializeNode('Email', $this->getEmail())
			. $this->getPersonName()->serialize()
			. $this->getAddress()->serialize()
			. $this->getTelephone()->serialize()
			. $this->getTransactionResponses()->serialize()
			. $this->_serializeOptionalDateValue('PaymentTransactionDate', 'c', $this->getPaymentTransactionDate())
			. $this->_serializeNode('PaymentTransactionTypeCode', $this->getPaymentTransactionTypeCode())
			. $this->_serializeOptionalValue('PaymentTransactionID', $this->getPaymentTransactionID())
			. $this->_serializeOptionalValue('ItemListRPH', $this->getItemListRPH())
			. $this->_serializeAmountNode('Amount', $this->getAmount(), $this->_currencyCode)
			. $this->_serializeAccountID()
			. $this->_serializeNode('TenderClass', $this->getTenderClass());
	}

	/**
         * Serialize the payment account unique id node if there's a valid value.
         *
         * @return string
         */
        protected function _serializeAccountID()
        {
                $isToken = $this->getIsToken();
                $isToken = !is_null($isToken) ? "true" : "false";
                $accountID = $this->getAccountID();
                return $accountID ? "<AccountID isToken=\"{$isToken}\">{$accountID}</AccountID>" : '';
        }
}
