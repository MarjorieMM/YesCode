<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
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

    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findLastArticles(3);
        $user = $this->getUser();

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'user' => $user,
            ]);
    }
}