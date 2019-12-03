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

    public function createPlayers() {
        $this->player1 = new Player('Anduin');
    }

    public function init()
    {
        $this->createPlayers();

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

        $deck = new Deck($cards);
        $deck->shuffle();

        $this->player1->draw(7, $deck);
        $this->player1->getSortedCards();

        return $this->render('hand.html.twig', [
            'player' => $this->player1,
            'deck' => $deck,
        ]);


    }
}
