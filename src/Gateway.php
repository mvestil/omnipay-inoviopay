<?php

/**
 * InovioPay Gateway
 */
namespace Omnipay\InovioPay;

use Omnipay\Common\AbstractGateway;

/**
 * Class Gateway
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