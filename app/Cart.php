<?php

namespace App;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
      if ($oldCart)
      {
          $this->items = $oldCart->items;
          $this->totalQty = $oldCart->totalQty;
          $this->totalPrice = $oldCart->totalPrice;
      }
    }

    /**
     * Dodaje produkt do koszyka,
     * wcześniej sprawdza czy nowa pozycja w koszyku nie jest zdublowana, jeśli jest to zwiększa tylko ilość
     * Metoda jest powiązana z getAddToCart() w ProductController.php
     * @param [Product] $item - obiekt klasy Product
     * @param [int] $id - id produktu w bazie
     */
    public function add($item, $id)
    {
      $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];

      if ($this->items)
      {
        if (array_key_exists($id, $this->items))
        {
          $storedItem = $this->items[$id];
        }
      }

      $storedItem['qty']++;
      $storedItem['price'] = $item->price * $storedItem['qty'];
      $this->items[$id] = $storedItem;
      $this->totalQty++;
      $this->totalPrice += $item->price;
    }

    /**
     * Zmniejsza ilość produktw w koszyku
     * @param  [type] $id [id produktu]
     * @return [type]     [description]
     */
    public function reduceByOne($id)
    {
      $this->items[$id]['qty']--;
      $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
      $this->totalQty--;
      $this->totalPrice -= $this->items[$id]['item']['price'];

      if ($this->items[$id]['qty'] <= 0)
      {
        unset($this->items[$id]);
      }
    }

    /**
     * Usuwam pozycję z koszyka o podanym id
     * Jeśli jest kilka takich samych to zmniejsza o jeden
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function removeItem($id)
    {
      $this->totalQty -= $this->items[$id]['qty'];
      $this->totalPrice -= $this->items[$id]['price'];
      unset($this->items[$id]);
    }
}
