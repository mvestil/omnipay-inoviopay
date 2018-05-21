<?php

namespace Omnipay\InovioPay;

use Omnipay\Common\ItemBag;
use Omnipay\Common\ItemInterface;

/**
 * Class InovioPayItemBag
 *
 * @date      3/5/18
 * @author    markbonnievestil
 */
class InovioPayItemBag extends ItemBag
{
    /**
     * Add an item to the bag
     *
     * @see Item
     *
     * @param ItemInterface|array $item An existing item, or associative array of item parameters
     */
    public function add($item)
    {
        if ($item instanceof ItemInterface) {
            $this->items[] = $item;
        } else {
            $this->items[] = new InovioPayItem($item);
        }
    }
}