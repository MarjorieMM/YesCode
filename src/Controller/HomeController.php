<?php

namespace App\Controller;

use App\Entity\Fruit;
use Doctrine\ORM\EntityManagerInterface;
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

    public function index(EntityManagerInterface $manager): Response
    {
        $banane = new Fruit();
        $banane->setNom('banane');
        $banane->setForme('allongée');
        $banane->setPoids(200);
        $banane->setPrix(1.2);

        dump($banane);

        $manager->persist($banane);
        $manager->flush();

        return $this->render('home/index.html.twig', [
            'fruit' => $banane,
                  ]);
    }
}