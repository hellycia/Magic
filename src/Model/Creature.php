<?php

namespace App\Model;


class Creature extends Card
{
    public $type;
    public $strength;
    public $endurance;
    // public $legendaire;
    public $static_capacity;
    public $active_capacity;

    public function __construct(string $name, int $cost, string $type, int $strength = 0, int $endurance = 1, string $static_capacity = '', string $active_capacity = '') # quand on fait un new Card, ça lance construct
    {
        parent::__construct($name, $cost, Card::TYPE_CREATURE);
        $this->type = $type;
        $this->strength = $strength;
        $this->endurance = $endurance;
        $this->static_capacity = $static_capacity;
        $this->active_capacity = $active_capacity;
    }
}
