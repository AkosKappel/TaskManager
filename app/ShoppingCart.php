<?php

namespace App;

class ShoppingCart
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * Vytvorenie inštancie košíka s danými položkami
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        $this->items = $items;
    }

    /**
     * Kontrola, či je daná položka v košíku
     * http://php.net/manual/en/function.in-array.php
     *
     * @param string $item
     * @return bool
     */
    public function has($item)
    {
        return in_array($item, $this->items);
    }

    /**
     * Výber a odobratie položky z košíka, alebo null ak je košík prázdny
     * http://php.net/manual/en/function.array-shift.php
     *
     * @return string
     */
    public function takeOne()
    {
        return array_shift($this->items);
    }

    /**
     * Vráti všetky položky z košíka, ktoré začínajú na dané písmeno
     * http://php.net/manual/en/function.array-filter.php
     * http://php.net/manual/en/function.stripos.php
     *
     * @param string $letter
     * @return array
     */
    public function startsWith($letter)
    {
        return array_filter($this->items, function ($item) use ($letter) {
            return stripos($item, $letter) === 0;
        });
    }
}
