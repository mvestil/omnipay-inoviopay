<?php

namespace Omnipay\InovioPay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class Response
 *
 * @date      3/5/18
 * @author    markbonnievestil
 */
class Response extends AbstractResponse
{
    /**
     * @var int
     */
    protected $statusCode;

    /**
     * Response constructor.
     *
     * @param RequestInterface $request
     * @param                  $data
     * @param int              $statusCode
     */
    public function __construct(RequestInterface $request, $data, $statusCode = 200)
    {
        parent::__construct($request, $data);
        $this->statusCode = $statusCode;
    }

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        // for Authorization/Refund/Void request
        if ($this->getCode() == 'APPROVED') {
            return true;
        }

        return false;
    }

    /**
     * InovioPay's API does not return standard codes in a single place so we use the TRANS_STATUS_NAME as the code
     *
     * @return null|string
     */
    public function getCode()
    {
        return isset($this->data['TRANS_STATUS_NAME']) ? $this->data['TRANS_STATUS_NAME'] : null;
    }

    public function getMessage()
    {
        if (!empty($this->data['SERVICE_ADVICE'])) {
            return $this->data['SERVICE_ADVICE'];
        }

        if (!empty($this->data['API_ADVICE'])) {
            return $this->data['API_ADVICE'];
        }

        if (!empty($this->data['PROCESSOR_ADVICE'])) {
            return $this->data['PROCESSOR_ADVICE'];
        }

        if (!empty($this->data['INDUSTRY_ADVICE'])) {
            return $this->data['INDUSTRY_ADVICE'];
        }

        return null;
    }

    public function getTransactionReference()
    {
        return !empty($this->data['PO_ID']) ? $this->data['PO_ID'] : null;
    }

    public function getCustomerReference()
    {
        return !empty($this->data['CUST_ID']) ? $this->data['CUST_ID'] : null;
    }

    public function getCardReference()
    {
        return !empty($this->data['PMT_ID']) ? $this->data['PMT_ID'] : null;
    }
}