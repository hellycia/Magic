<?php

namespace App\Model;


class Card
{
    public $name;
    public $cost;
    public $class;
    public $effect;

    public function __construct(string $name, int $cost, string $class) # quand on fait un new Card, ça lance construct
    {
        $this->name = $name;
        $this->cost = $cost;
        $this->class = $class;
    }
}
