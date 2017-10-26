<?php

namespace CodeHouse\EstCard\Model;

use CodeHouse\EstCard\Utils;

/**
 * EstCard response object model
 */
class EstCardResponse
{
    private $_version;
    private $_eComServiceId;
    private $_transactionNumber;
    private $_receiptNumber;
    private $_amountInCents;
    private $_currency;
    private $_responseCode;
    private $_dateTime;
    private $_paymentDetails;
    private $_responseText;
    private $_mac;

    /**
     * Create EstCard response object for processing
     *
     * @param string[] $request Array from $_REQUEST (This is the data that is posted to post-back URL)
     */
    function __construct($request) {
        $this->setEComServiceId(@$request['id']);
        $this->setTransactionNumber(@$request['ecuno']);
        $this->setResponseCode(@$request['respcode']);
        $this->setCurrency(@$request['cur']);
        $this->setDateTime(@$request['datetime']);
        $this->setVersion(@$request['ver']);
        $this->setReceiptNumber(@$request['receipt_no']);
        $this->setAmountInCents(@$request['eamount']);
        $this->setPaymentDetails(@$request['msgdata']);
        $this->setResponseText(@$request['actiontext']);
        $this->setMac(@$request['mac']);
    }

    /**
     * @return mixed
     */
    public function getMac() {
        return $this->_mac;
    }

    /**
     * @param mixed $mac
     */
    public function setMac($mac) {
        $this->_mac = Utils::hex2str($mac);
    }

    public function getData() {
        return $this->getVersion()
            . $this->getEComServiceId()
            . $this->getTransactionNumber()
            . $this->getReceiptNumber()
            . $this->getAmountInCents()
            . $this->getCurrency()
            . $this->getResponseCode()
            . $this->getDateTime()
            . $this->getPaymentDetails()
            . $this->getResponseText();
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
     * @param mixed $eComServiceId
     */
    public function setEComServiceId($eComServiceId) {
        $this->_eComServiceId = $eComServiceId;
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
        $this->_transactionNumber = $transactionNumber;
    }

    /**
     * @return mixed
     */
    public function getReceiptNumber() {
        return $this->_receiptNumber;
    }

    /**
     * @param mixed $receiptNumber
     */
    public function setReceiptNumber($receiptNumber) {
        $this->_receiptNumber = sprintf("%06s", $receiptNumber);
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
    public function getResponseCode() {
        return $this->_responseCode;
    }

    /**
     * @param mixed $responseCode
     */
    public function setResponseCode($responseCode) {
        $this->_responseCode = $responseCode;
    }

    /**
     * @return mixed
     */
    public function getDateTime() {
        return $this->_dateTime;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime) {
        $this->_dateTime = $dateTime;
    }

    /**
     * @return mixed
     */
    public function getPaymentDetails() {
        return $this->_paymentDetails;
    }

    /**
     * @param mixed $paymentDetails
     */
    public function setPaymentDetails($paymentDetails) {
        $this->_paymentDetails = Utils::mb_sprintf("%-40s", $paymentDetails);
    }

    /**
     * @return mixed
     */
    public function getResponseText() {
        return $this->_responseText;
    }

    /**
     * @param mixed $responseText
     */
    public function setResponseText($responseText) {
        $this->_responseText = Utils::mb_sprintf("%-40s", $responseText);
    }

}
