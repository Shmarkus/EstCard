<?php

namespace CodeHouse\EstCard\Model;

/**
 * EstCard request object model
 */
class EstCardRequest
{
    private $_language;
    private $_action;
    private $_version;
    private $_eComServiceId;
    private $_transactionNumber;
    private $_amountInCents;
    private $_currency;
    private $_datetime;
    private $_encoding;
    private $_feedbackUrl;
    private $_deliveryMethod;

    /**
     * Create EstCard request object. Mandatory fields are first 3.
     *
     * @param string $_eComServiceId Your unique ID (10 characters). Get it from Nets
     * @param int $_amountInCents Amount to be paid in cents
     * @param string $_feedbackUrl URL to post the response by Nets
     * @param string $_language Communication language in ISO 639-1. Default 'en'
     * @param string $_datetime Transaction date-time in ISO-8601 (YmdHis). Defaults to current time
     * @param string $_encoding Content encoding. Defaults to UTF-8
     * @param string $_currency Transaction currency in ISO-4217. Defaults to EUR
     * @param string $_deliveryMethod Delivery method description. Defaults to S
     * @param string $_version Version of the protocol. Defaults to 004
     * @param string $_action Payment form identifier. Defaults to gaf
     * @param string $transactionNumber Current transaction number (mainly for testing)
     *
     * @see https://www.nets.eu/etee/Pages/Test-keskkond.aspx
     */
    function __construct($_eComServiceId, $_amountInCents, $_feedbackUrl, $_language = 'en', $_datetime = '', $_encoding = 'UTF-8', $_currency = 'EUR', $_deliveryMethod = 'S', $_version = '004', $_action = 'gaf', $transactionNumber = '') {
        $this->setEComServiceId($_eComServiceId);
        $this->setAmountInCents($_amountInCents);
        $this->setFeedbackUrl($_feedbackUrl);
        $this->setLanguage($_language);
        $this->setDatetime($_datetime);
        $this->setEncoding($_encoding);
        $this->setCurrency($_currency);
        $this->setDeliveryMethod($_deliveryMethod);
        $this->setVersion($_version);
        $this->setAction($_action);
        $this->setTransactionNumber($transactionNumber);
    }

    /**
     * @return mixed
     */
    public function getLanguage() {
        return $this->_language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language) {
        $this->_language = $language;
    }

    /**
     * @return mixed
     */
    public function getAction() {
        return $this->_action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action) {
        $this->_action = $action;
    }

    /**
     * @return mixed
     */
    public function getEncoding() {
        return $this->_encoding;
    }

    /**
     * @param mixed $encoding
     */
    public function setEncoding($encoding) {
        $this->_encoding = $encoding;
    }

    /**
     * @return mixed
     */
    public function getData() {
        return $this->getVersion()
            . $this->getEComServiceId()
            . $this->getTransactionNumber()
            . $this->getAmountInCents()
            . $this->getCurrency()
            . $this->getDatetime()
            . $this->getFeedbackUrl()
            . $this->getDeliveryMethod();
    }

    /**
     * @return mixed
     */
    public function getVersion() {
        return $this->_version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version) {
        $this->_version = sprintf("%03s", $version);
    }

    /**
     * @return mixed
     */
    public function getEComServiceId() {
        return $this->_eComServiceId;
    }

    /**
     * @param mixed $id
     */
    public function setEComServiceId($id) {
        $this->_eComServiceId = $id;
    }

    /**
     * @return mixed
     */
    public function getTransactionNumber() {
        return $this->_transactionNumber;
    }

    /**
     * @param mixed $transactionNumber
     */
    public function setTransactionNumber($transactionNumber) {
        if ($transactionNumber === '') {
            $this->_transactionNumber = date("Ym") . rand(100000, 999999);
        } else {
            $this->_transactionNumber = $transactionNumber;
        }

    }

    /**
     * @return mixed
     */
    public function getAmountInCents() {
        return $this->_amountInCents;
    }

    /**
     * @param mixed $amountInCents
     */
    public function setAmountInCents($amountInCents) {
        $this->_amountInCents = sprintf("%012s", $amountInCents);
    }

    /**
     * @return mixed
     */
    public function getCurrency() {
        return $this->_currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency) {
        $this->_currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getDatetime() {
        return $this->_datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime) {
        if ($datetime === '') {
            $this->_datetime = date("YmdHis");
        } else {
            $this->_datetime = $datetime;
        }
    }

    /**
     * @return mixed
     */
    public function getFeedbackUrl() {
        return $this->_feedbackUrl;
    }

    /**
     * @param mixed $feedbackUrl
     */
    public function setFeedbackUrl($feedbackUrl) {
        $this->_feedbackUrl = sprintf("%-128s", $feedbackUrl);
    }

    /**
     * @return mixed
     */
    public function getDeliveryMethod() {
        return $this->_deliveryMethod;
    }

    /**
     * @param mixed $deliveryMethod
     */
    public function setDeliveryMethod($deliveryMethod) {
        $this->_deliveryMethod = $deliveryMethod;
    }

}
