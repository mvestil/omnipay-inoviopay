<?php

/**
 * InovioPay Gateway
 */
namespace Omnipay\InovioPay;

use Omnipay\Common\AbstractGateway;

/**
 * InovioPay Gateway
 *
 * Inovio is the revolutionary new payments gateway with seamless integration and global scalability that continuously evolves with the industry.
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
 * </code>
 *
 * ### Quirks
 *
 * Card and Token payment is supported. In order to create a token payment, customer id (cust_id) and payment id (pmt_id) must be passed.
 * You can get these values from the response of the first purchase using Card payment.
 * This package supports only single item purchase and multiple items will only be supported in the future release.
 * For this package to work, you must pass the API credentials as part of the request body including the Product Id (li_prod_id_1) which can be created
 * in InovioPay portal by creating product with type "Variable Price Product"
 *
 * ### Test modes
 *
 * The API has only one endpoint which is https://api.inoviopay.com/payment/pmt_service.cfm
 *
 * ### Authentication
 *
 * To call InovioPay Payments API, reqUsername, reqPassword, siteId, merchAcctId must be passed.
 * This can be seen in InovioPay admin portal.
 *
 * @date      30/4/18
 * @author    markbonnievestil
 */
class Gateway extends AbstractGateway
{
    /**
     * Get the gateway name
     *
     * @return string
     */
    public function getName()
    {
        return 'InovioPay';
    }

    /**
     * Get default parameters
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'reqUsername' => '',
            'reqPassword' => '',
            'siteId'      => '',
            'merchAcctId' => '',
            'testMode'    => false,
        );
    }

    /**
     * @return string
     */
    public function getReqUsername()
    {
        return $this->getParameter('reqUsername');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setReqUsername($value)
    {
        return $this->setParameter('reqUsername', $value);
    }

    /**
     * @return string
     */
    public function getReqPassword()
    {
        return $this->getParameter('reqPassword');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setReqPassword($value)
    {
        return $this->setParameter('reqPassword', $value);
    }

    /**
     * @return string
     */
    public function getSiteId()
    {
        return $this->getParameter('siteId');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setSiteId($value)
    {
        return $this->setParameter('siteId', $value);
    }

    /**
     * @return string
     */
    public function getMerchAcctId()
    {
        return $this->getParameter('merchAcctId');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMerchAcctId($value)
    {
        return $this->setParameter('merchAcctId', $value);
    }

    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->getParameter('productId');
    }

    /**
     * @param $value
     * @return $this
     */
    public function setProductId($value)
    {
        return $this->setParameter('productId', $value);
    }

    /**
     * Create a purchase request.
     *
     * @param array $parameters
     * @return \Omnipay\InovioPay\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\InovioPay\Message\PurchaseRequest', $parameters);
    }

    /**
     * Create a purchase request.
     *
     * @param array $parameters
     * @return \Omnipay\InovioPay\Message\PurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\InovioPay\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * Create a refund request.
     *
     * @param array $parameters
     * @return \Omnipay\InovioPay\Message\RefundRequest
     */
    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\InovioPay\Message\RefundRequest', $parameters);
    }

    /**
     * Create a void request.
     *
     * @param array $parameters
     * @return \Omnipay\InovioPay\Message\VoidRequest
     */
    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\InovioPay\Message\VoidRequest', $parameters);
    }
}