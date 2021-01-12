<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Faker;
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
        $articles = $repo->FindLastArticles(3);
        $faker = Faker\Factory::create('fr_FR');

        // $title = $faker->sentence(2);

        // $intro = $faker->paragraph(2);

        $content = '<p>'.implode('</p><p>', $faker->paragraphs(7)).'</p>';

        $createdAt = $faker->dateTimeBetween('- 3 months');

        dump($createdAt);

        $image = 'https://picsum.photos/400/300';

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'image' => $image,
            'content' => $content,
            ]);
    }
}