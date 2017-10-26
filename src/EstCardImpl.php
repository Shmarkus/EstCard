<?php

namespace CodeHouse\EstCard;

use CodeHouse\EstCard\Model\EstCardRequest;
use CodeHouse\EstCard\Model\EstCardResponse;

class EstCardImpl implements EstCard
{
    private $_privateKeyFile;
    private $_publicKeyFile;

    private $_estCardKey;
    private $_postBackUrl;
    private $_estCardUrl;

    /**
     * Initialize EstCard library
     *
     * @param string $privateKeyFile Path to private key file
     * @param string $publicKeyFile Path to public key file
     * @param string $postBackUrl URL to post response to
     * @param string $estCardKey Ecom service ID (given out by Nets). Defaults to test key
     * @param string $estCardUrl URL to post request to. Defaults to test environment
     */
    function __construct($privateKeyFile, $publicKeyFile, $postBackUrl, $estCardKey = '318DC77DC8', $estCardUrl = 'https://pos.estcard.ee/test-pos/iPayServlet') {
        $this->_privateKeyFile = $privateKeyFile;
        $this->_publicKeyFile = $publicKeyFile;
        $this->_estCardKey = $estCardKey;
        $this->_postBackUrl = $postBackUrl;
        $this->_estCardUrl = $estCardUrl;
    }

    public function validateResponse($post) {
        $response = new EstCardResponse($post);
        $publicKey = openssl_get_publickey(file_get_contents($this->_publicKeyFile));
        $verifyResult = openssl_verify($response->getData(), $response->getMac(), $publicKey);
        openssl_free_key($publicKey);
        return $verifyResult;
    }

    public function getHtmlForm($sum) {
        $request = new EstCardRequest($this->_estCardKey, $sum, $this->_postBackUrl);

        return '<form action="' . $this->_estCardUrl . '" method="POST" id="estcard">' .
            '<input type="hidden" name="lang" value="' . $request->getLanguage() . '"/>' .
            '<input type="hidden" name="action" value="' . $request->getAction() . '"/>' .
            '<input type="hidden" name="ver" value="' . $request->getVersion() . '"/>' .
            '<input type="hidden" name="id" value="' . $request->getEComServiceId() . '"/>' .
            '<input type="hidden" name="ecuno" value="' . $request->getTransactionNumber() . '"/>' .
            '<input type="hidden" name="eamount" value="' . $request->getAmountInCents() . '"/>' .
            '<input type="hidden" name="cur" value="' . $request->getCurrency() . '"/>' .
            '<input type="hidden" name="datetime" value="' . $request->getDatetime() . '"/>' .
            '<input type="hidden" name="charEncoding" value="' . $request->getEncoding() . '"/>' .
            '<input type="hidden" name="feedBackUrl" value="' . $request->getFeedbackUrl() . '"/>' .
            '<input type="hidden" name="delivery" value="' . $request->getDeliveryMethod() . '"/>' .
            '<input type="hidden" name="mac" value="' . $this->generateMac($request) . '"/>' .
            '</form>';
    }

    /**
     * Generate MAC from $request
     *
     * @param EstCardRequest $request
     * @return string MAC of the model
     */
    public function generateMac(EstCardRequest $request) {
        $key = openssl_get_privatekey(file_get_contents($this->_privateKeyFile));
        openssl_sign($request->getData(), $signature, openssl_get_privatekey($key));
        openssl_free_key($key);
        return bin2hex($signature);
    }

}
