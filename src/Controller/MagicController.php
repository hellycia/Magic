<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Model\Player;
use App\Model\Deck;
use App\Model\Card;
use App\Model\Creature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MagicController extends AbstractController
{
    private Player $player1;
    private Player $player2;
    private Deck $deck1;
    private Deck $deck2;

    public function list()
    {

        // $tables = [];
        // $y = 1;
        // for ($i = 1; $i <= 100; $i++) {
        //     $tables['table ' . $i] = [
        //         new Player('Player ' . $y),
        //         new Player('Player ' . ($y + 1))
        //     ];
        //     $y = $y + 2;
        // }

        $kirby = new Player('Kirby');
        $kirby->draw(7);
        $kirby->draw();

        $yoshi = new Player('Yoshi');
        $yoshi->draw(7);

        $tables =[
            'table rouge' => [
                $kirby,
                $yoshi,
            ],
            'table bleu' => [
                new Player('Link'),
                new Player('Pikachu'),
            ]
        ];


        $roundNumber = 2;

        return $this->render('players.html.twig', [
            'tables' => $tables,
            'roundNumber' => $roundNumber,
        ]);
    }

    public function createPlayer(string $name)
    {
        return new Player($name);

    }

    public function createDeck()
    {
        $cards = [];

        for ($i = 1; $i <= 30; $i++) {
            $card = new Creature('Némésis', 3, 'Merfolk Rogue');
            $cards[]= $card;
        }

        for ($i = 1; $i <= 20; $i++) {
            $card = new Card('Island', 0, 'land');
            $cards[]= $card;
        }

        for ($i = 1; $i <= 10; $i++) {
            $card = new Card('Force of Will', 3, 'spell');
            $cards[]= $card;
        }




        # autre manière de faire une boucle ++
        // $i = 0;
        // while ($i < 30) {
        //     $card = new Card('Nemesis', 3, 'monster');
        //     $cards[]= $card;
        //     $i ++;
        // }

        // var_dump($cards);

        return new Deck($cards);

    }

    public function init()
    {
        $this->player1 = $this->createPlayer('Anduin');
        $this->player2 = $this->createPlayer('Sylvanas');
        $this->deck1 = $this->createDeck();
        $this->deck1->shuffle();
        $this->deck2 = $this->createDeck();
        $this->deck2->shuffle();

        $this->player1->draw(7, $this->deck1);
        $this->player1->getSortedCards();

        $this->player2->draw(7, $this->deck2);
        $this->player2->getSortedCards();


    }

    public function play()
    {
        $this->init();

        return $this->render('hand.html.twig', [
            'playerone' => $this->player1,
            'playertwo' => $this->player2,
            'deckone' => $this->deck1,
            'decktwo' => $this->deck2,
        ]);
    }
}
