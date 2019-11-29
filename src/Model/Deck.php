<?php

namespace App\Model;


class Deck
{
    const STARTING_DECK_MIN=60;

    public $cards;

    public function __construct(array $cards) # quand on fait un new Deck, ça lance construct
    {
        $this->cards = $cards;
    }

    // public function isValid()
    // {
    //     if (count($cards) >= 60) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function isValid(): bool
    {
        return count($cards) >= self:: STARTING_DECK_MIN;
    }

}
