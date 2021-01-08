<?php

namespace App\Controller;

use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */

    //  Pour ajouter dans la base de données :
    // Le même produit s'ajoute à chaque chargement de page

    public function index(FruitRepository $repo): Response
    {
        $fruits = $repo->findAll();
        dump($fruits);

        return $this->render('home/index.html.twig', [
            'fruits' => $fruits,
            ]);
    }
}