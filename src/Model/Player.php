<?php

namespace App\Model;


class Player
{
    # Constante, ça ne bouge pas
    const STARTING_HP=20;
    const STARTING_CARD=7;

    # attributs de la class, ce qui définit la class, ses caracs
    public $name;
    public $hp;
    public $cardNumber = 0;


    # method de la class, action possible sur la class
    public function __construct(string $name) # quand on fait un new Player, ça lance construct
    {
        $this->name = $name;
        $this->hp = self::STARTING_HP;
    }

    /**
     * method draw, elle a un paramètre qui est le nombre de carte à piocher par défaut qui est de 1
     */
    public function draw(int $drawingCardNumber = 1)
    {
        $this->cardNumber = $this->cardNumber + $drawingCardNumber;
    }
}
