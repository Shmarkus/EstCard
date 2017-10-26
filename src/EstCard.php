<?php

namespace CodeHouse\EstCard;

interface EstCard
{
    const VALIDATE_OK = 1;
    const VALIDATE_NOK = 0;
    const VALIDATE_ERR = -1;
    const PAYMENT_OK = '000';

    /**
     * Validate response from Nets
     *
     * @param string[] $response
     *
     * @return int Result code: EstCard::VALIDATE_OK, EstCard::VALIDATE_NOK, EstCard::VALIDATE_ERR
     */
    public function validateResponse($response);

    /**
     * Method prints out EstCard HTML form. To send the data to EstCardURL, submit form with id 'estcard'
     *
     * @return string Hidden HTML form
     */
    public function getHtmlForm($sum);
}
