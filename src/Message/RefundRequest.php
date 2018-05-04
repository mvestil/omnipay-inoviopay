<?php

namespace Omnipay\InovioPay\Message;

/**
 * Class RefundRequest
 *
 * @date      3/5/18
 * @author    markbonnievestil
 */
class RefundRequest extends AbstractRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = parent::getData();

        $this->validate('transactionReference', 'amount');

        $data['request_action']    = 'CCCREDIT';
        $data['request_ref_po_id'] = $this->getTransactionReference();
        $data['li_value_1']        = $this->getAmount();

        return $data;
    }
}
