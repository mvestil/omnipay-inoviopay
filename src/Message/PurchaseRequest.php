<?php

namespace Omnipay\InovioPay\Message;

/**
 * Class ${NAME}
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