<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Model\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CakeController extends AbstractController
{
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
}
