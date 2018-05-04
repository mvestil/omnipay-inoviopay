<?php

namespace Omnipay\InovioPay\Message;

/**
 * Class VoidRequest
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