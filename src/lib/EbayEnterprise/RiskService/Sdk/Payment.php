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

class EbayEnterprise_RiskService_Sdk_Payment
	extends EbayEnterprise_RiskService_Sdk_Info
	implements EbayEnterprise_RiskService_Sdk_IPayment
{
	/** @var EbayEnterprise_RiskService_Sdk_Payment_ICard */
	protected $_paymentCard;
	/** @var DateTime */
	protected $_paymentTransactionDate;
	/** @var string */
	protected $_currencyCode;
	/** @var float */
	protected $_amount;
	/** @var int */
	protected $_totalAuthAttemptCount;
	/** @var EbayEnterprise_RiskService_Sdk_Transaction_IResponses */
	protected $_transactionResponses;
	/** @var EbayEnterprise_RiskService_Sdk_IAuthorization */
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
                        'setIsToken' => 'string(x:PaymentAccountUniqueId/@isToken)',
                );

	}

	/**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::getAccountID()
         */
        public function getAccountID()
        {
                return $this->_accountID;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::setAccountID()
         */
        public function setAccountID($accountID)
        {
                $this->_accountID = $accountID;
                return $this;
        }

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IPayment::getPaymentCard()
	 */
	public function getPaymentCard()
	{
		return $this->_paymentCard;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IPayment::setPaymentCard()
	 */
	public function setPaymentCard(EbayEnterprise_RiskService_Sdk_Payment_ICard $paymentCard)
	{
		$this->_paymentCard = $paymentCard;
		return $this;
	}

	/**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::getAuthorization()
         */
        public function getAuthorization()
        {
                return $this->_authorization;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::setAuthorization()
         */
        public function setAuthorization(EbayEnterprise_RiskService_Sdk_IAuthorization $authorization)
        {
                $this->_authorization = $authorization;
                return $this;
        }

	/**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::getItemListRPH()
         */
        public function getItemListRPH()
        {
                return $this->_itemListRPH;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::setItemListRPH()
         */
        public function setItemListRPH($itemListRPH)
        {
                $this->_itemListRPH = $itemListRPH;
                return $this;
        }

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IPayment::getPaymentTransactionDate()
	 */
	public function getPaymentTransactionDate()
	{
		return $this->_paymentTransactionDate;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IPayment::setPaymentTransactionDate()
	 */
	public function setPaymentTransactionDate(DateTime $paymentTransactionDate)
	{
		$this->_paymentTransactionDate = $paymentTransactionDate;
		return $this;
	}

	/**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::getPaymentTransactionID()
         */
        public function getPaymentTransactionID()
        {
                return $this->_paymentTransactionID;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::setPaymentTransactionID()
         */
        public function setPaymentTransactionID($paymentTransactionID)
        {
                $this->_paymentTransactionID = $paymentTransactionID;
                return $this;
        }

	/**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::getPaymentTransactionTypeCode()
         */
        public function getPaymentTransactionTypeCode()
        {
                return $this->_paymentTransactionTypeCode;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::setPaymentTransactionTypeCode()
         */
        public function setPaymentTransactionTypeCode($paymentTransactionTypeCode)
        {
                $this->_paymentTransactionTypeCode = $paymentTransactionTypeCode;
                return $this;
        }

	/**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::getTenderClass()
         */
        public function getTenderClass()
        {
                return $this->_tenderClass;
        }

        /**
         * @see EbayEnterprise_RiskService_Sdk_IPayment::setTenderClass()
         */
        public function setTenderClass($tenderClass)
        {
                $this->_tenderClass = $tenderClass;
                return $this;
        }

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IPayment::getCurrencyCode()
	 */
	public function getCurrencyCode()
	{
		return $this->_currencyCode;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IPayment::setCurrencyCode()
	 */
	public function setCurrencyCode($currencyCode)
	{
		$this->_currencyCode = $currencyCode;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IPayment::getAmount()
	 */
	public function getAmount()
	{
		return $this->_amount;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IPayment::setAmount()
	 */
	public function setAmount($amount)
	{
		$this->_amount = $amount;
		return $this;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IPayment::getTransactionResponses()
	 */
	public function getTransactionResponses()
	{
		return $this->_transactionResponses;
	}

	/**
	 * @see EbayEnterprise_RiskService_Sdk_IPayment::setTransactionResponses()
	 */
	public function setTransactionResponses(EbayEnterprise_RiskService_Sdk_Transaction_IResponses $transactionResponses)
	{
		$this->_transactionResponses = $transactionResponses;
		return $this;
	}

	/**
         * @see EbayEnterprise_RiskService_Sdk_Payment_ICard::getIsToken()
         */
        public function getIsToken()
        {
                return $this->_isToken;
        }

	/**
         * @see EbayEnterprise_RiskService_Sdk_Payment_ICard::setIsToken()
         */
        public function setIsToken($isToken)
        {
                $this->_isToken = $isToken;
                return $this;
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
                $isToken = !is_null($isToken) ? $isToken : false;
                $accountID = $this->getAccountID();
                return $accountID ? "<AccountID isToken=\"{$isToken}\">{$accountID}</AccountID>" : '';
        }
}
