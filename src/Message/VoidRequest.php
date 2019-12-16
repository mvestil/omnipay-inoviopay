<?php

namespace Omnipay\InovioPay\Message;

/**
 * Class VoidRequest
 *
 * This class is use to request void to InovioPay
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
 *     $sale_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $sale_id . "\n";
 * }
 *
 * #### Refund Payment
 *
 * To refund a payment, you must pass the transaction reference of the payment that you can get
 * by calling getTransactionReference() from the response of the previous purchase.
 *
 * <code>
 * $transaction = $gateway->void(array(
 *     'transactionReference' => $sale_id
 * ));
 *
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Purchase transaction was successful!\n";
 * }
 *
 * $response = $transaction->send();
 * </code>
 *
 * @date      3/5/18
 * @author    markbonnievestil
 */
class VoidRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = parent::getData();

        $this->validate('transactionReference');

        $data['request_action']    = 'CCREVERSE';
        $data['request_ref_po_id'] = $this->getTransactionReference();
        $data['credit_on_fail']    = 1;

        return $data;
    }
}