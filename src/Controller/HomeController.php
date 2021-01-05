<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        // J'envoie tout ça à ma vue pour l'afficher
        return $this->render('home/index.html.twig', [
            'name' => 'Page d\'accueil',
                  ]);
    }
}