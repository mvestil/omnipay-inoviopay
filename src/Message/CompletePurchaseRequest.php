<?php

namespace Omnipay\InovioPay\Message;

/**
 * Class CompletePurchaseRequest
 *
 * @date      3/5/18
 * @author    markbonnievestil
 * @copyright Copyright (c) Infostream Group
 */

class CompletePurchaseRequest extends AuthorizeRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $this->validate('p3dsTransId', 'pares');

        $data                   = parent::getData();
        $data['request_action'] = 'CCAUTHCAP';
        $data['p3ds_transid']   = $this->getP3dsTransId();
        $data['request_pares']  = $this->getPares();

        //\Log::info('data 3ds', [$data]);

        return $data;
    }
}