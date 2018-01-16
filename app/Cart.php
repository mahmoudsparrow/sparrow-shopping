<?php

namespace App;


use Illuminate\Contracts\Session\Session;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storedItem = ['item' => $item, 'qty' => 0, 'price' => $item->price];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
//        $this->totalPrice += $storedItem['price'];
//        global $totalPrice;
//        foreach ($this->items as $item) {
//            $totalPrice += $item['price'];
////            dd($item['price']);
//        }
//        $this->totalPrice = $totalPrice;
    }

    // remove an item from the cart
    public function removeItem($item, $id)
    {
//        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if (array_key_exists($id, $this->items)) {
            $storedItem = $this->items[$id];
            $storedItem['qty']--;
            if ($storedItem['qty'] != 0) {
                $storedItem['price'] = $item->price * $storedItem['qty'];
                $this->items[$id] = $storedItem;
                $this->totalQty--;
                $this->totalPrice -= $storedItem['price'];
            } else {
                $storedItem['price'] = $item->price * $storedItem['qty'];
                $this->totalQty--;
                $this->totalPrice -= $storedItem['price'];
                unset($this->items[$id]);
                if (!$this->totalQty) {
                    $this->totalQty = null;
                }
            }
        }
    }

    // remove all similar items from the cart
    public function removeAllItems($item, $id)
    {
        if (array_key_exists($id, $this->items)) {
            $storedItem = $this->items[$id];
            $storedItem['price'] = $item->price * $storedItem['qty'];
            $this->totalQty -= $storedItem['qty'];
            $this->totalPrice -= $storedItem['price'];
            $storedItem['qty'] = 0;
            unset($this->items[$id]);
            if (!$this->totalQty) {
                $this->totalQty = null;
            }
        }
    }

    // remove or delete all the cart
    public function removeAllItem()
    {
        $this->items = null;
        $this->totalQty = 0;
        $this->totalPrice = 0;
    }
}