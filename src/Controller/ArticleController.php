<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    // public function index(ArticleRepository $repo): Response
    // {
    public function index(): Response
    {
        // $articles = $repo->findAll();
        // dump($articles);
        $articleRepository = $this->getDoctrine()
        ->getManager()
        ->getRepository('App\Entity\Article');
        $articles = $articleRepository->findAll();

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}