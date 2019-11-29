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
    public $cards;


    # method de la class, action possible sur la class
    public function __construct(string $name) # quand on fait un new Player, ça lance construct
    {
        $this->name = $name;
        $this->hp = self::STARTING_HP;
        $this->cards = [];
    }

    /**
     * method draw, elle a un paramètre qui est le nombre de carte à piocher par défaut qui est de 1
     */
    public function draw(int $drawingCardNumber = 1, Deck $deck)
    {
        //$this->cardNumber = $this->cardNumber + $drawingCardNumber;
        for ($i = 0; $i < $drawingCardNumber; $i ++) {
            $card = $deck->cards[0];
            array_shift($deck->cards);
            $this->cards[] = $card;
        }
    }
    #ranger les cartes dans le tableau assossiatif: on utilise le nom des cartes, si le nom est déjà apparu on met + 1

    public function getSortedCards()
    {
        $sortedCards = [];

        foreach ($this->cards as $card) {
            $cardName = $card->name;
            if (array_key_exists($cardName, $sortedCards)) {
                $sortedCards[$cardName] += 1;
            } else {
                $sortedCards[$cardName] = 1;
            }
        }

        return $sortedCards;

    }

    # on regarde dans la main du joueur si il n'a pas de terrain ou si il en a plus de 6, si c'est le cas il a besoin de mulligan
    public function wantMulligan(): bool
    {
        $sortedCards = $this->getSortedCards();
        if (array_key_exists('Island', $sortedCards) and $sortedCards['Island'] < 6 ) {
            return false;
        } else {
            return true;
        }
    }

    # pour chaque carte du joueur, on les remets dans le deck, on dit que la liste de carte dans la main est vide, on mélange et le joueur repioche 6 cartes
    public function mulligan(Deck $deck)
    {
        foreach ($this->cards as $card) {
            $deck->cards[] = $card;
        }
        $this->cards = [];
        $deck->shuffle();
        $this->draw(6, $deck);
    }

}
