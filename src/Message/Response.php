<?php

namespace Omnipay\InovioPay\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * Class Response
 *
 * @date      3/5/18
 * @author    markbonnievestil
 */
class Response extends AbstractResponse implements RedirectResponseInterface
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

    /**
     * @return null|string
     */
    public function getMessage()
    {
        // InovioPay returns advices with empty spaces, so use trim()
        if (!empty($this->data['SERVICE_ADVICE']) && trim($this->data['SERVICE_ADVICE'])) {
            return $this->data['SERVICE_ADVICE'];
        }

        if (!empty($this->data['API_ADVICE']) && trim($this->data['API_ADVICE'])) {
            return $this->data['API_ADVICE'];
        }

        if (!empty($this->data['PROCESSOR_ADVICE']) && trim($this->data['PROCESSOR_ADVICE'])) {
            return $this->data['PROCESSOR_ADVICE'];
        }

        if (!empty($this->data['INDUSTRY_ADVICE']) && trim($this->data['INDUSTRY_ADVICE'])) {
            return $this->data['INDUSTRY_ADVICE'];
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function getTransactionReference()
    {
        return !empty($this->data['PO_ID']) ? $this->data['PO_ID'] : null;
    }

    /**
     * @return null
     */
    public function getCustomerReference()
    {
        return !empty($this->data['CUST_ID']) ? $this->data['CUST_ID'] : null;
    }

    /**
     * @return null
     */
    public function getCardReference()
    {
        return !empty($this->data['PMT_ID']) ? $this->data['PMT_ID'] : null;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return $this->getRedirectUrl() !== null;
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        return !empty($this->data['PROC_REDIRECT_URL']) ? $this->data['PROC_REDIRECT_URL'] : null;
    }

    /**
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    /**
     * @return array|mixed
     */
    public function getRedirectData()
    {
        if ($this->isRedirect()) {
            return $this->data;
        }
    }
}