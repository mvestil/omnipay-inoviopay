<?php

namespace Omnipay\InovioPay\Message;

/**
 * Class PurchaseRequest
 *
 * This class is used for making Card & Token Payment.
 * It uses the request_action CCAUTHCAP that means Authorize & Capture.
 *
 * ### Example
 * <code>
 * // Initialize the gateway
 * $gateway = Omnipay::create('InovioPay');
 * $gateway->initialize(array(
 *     'reqUsername' => 'XXXXXXXXXXXX',
 *     'reqPassword' => 'XXXXXXXXXXXX',
 *     'siteId'      => '64557',
 *     'merchAcctId' => '66824',
 *     'testMode'    => true,
 *     'productId'   => 85299,
 * ));
 *
 * // Create a credit card object
 * $card = new CreditCard(array(
 *     'firstName'       => 'Example',
 *     'lastName'        => 'Customer',
 *     'number'          => '4242424242424242',
 *     'expiryMonth'     => '01',
 *     'expiryYear'      => '2032',
 *     'cvv'             => '123',
 *     'email'           => 'customer@example.com',
 *     'billingAddress1' => 'Mary',
 *     'billingCountry'  => 'SG',
 *     'billingCity'     => 'Singapore',
 *     'billingPostcode' => '567278',
 *     'billingState'    => 'Singapore',
 * ));
 *
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase(array(
 *     'amount'      => '50.00',
 *     'currency'    => 'USD',
 *     'card'        => $card,
 *     'transactionId' => random_int(0, 1000000000),
 * ));
 *
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Purchase transaction was successful!\n";
 *     $token = $response->getCardReference();
 *     $customerToken = $response->getCustomerReference();
 *     echo "Card reference = " . $token . "\n";
 *     echo "Customer reference = " . $customerToken . "\n";
 * }
 * </code>
 *
 * #### Token Payment
 *
 * To obtain a card reference (the cardReference parameter) a previous purchase
 * call must be completed successfully.  After the successful completion, check
 * the result of getCardReference & getCustomerReference on the response:
 *
 * <code>
 * // Do a Token transaction on the gateway
 * $transaction = $gateway->purchase(array(
 *     'amount'            => '50.0',
 *     'currency'          => 'USD',
 *     'cardReference'     => $token, // pmt_id from the response of the previous purchase
 *     'customerReference' => $customerToken, // cust_id from the response of the previous purchase
 * ));
 *
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Purchase transaction was successful!\n";
 *     $sale_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $sale_id . "\n";
 * }
 * </code>
 *
 * @date      3/5/18
 * @author    markbonnievestil
 * @copyright Copyright (c) Infostream Group
 */
class PurchaseRequest extends AuthorizeRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data                   = parent::getData();
        $data['request_action'] = 'CCAUTHCAP';

        return $data;
    }
}