<?php

namespace App\Controller;

use stdClass;
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
        //    Je déclare une variable PHP de type String
        $author = 'Loïs Lane';
        $jeanDaniel = 'Jean Daniel';
        // j'instancie un objet standard PHP sans classe créé par nous nous-même
        //je n'oublie pas l'import | namespaceresolver -> plugin
        $article = new stdClass();
        //J'attribut des propriétés à mon objet
        $article->title = 'Théorie du complot';
        $article->intro = 'Fascine depuis des lustres ! On vous dit tout';
        $article->content = 'Bla bla bla';
        $michel = new stdClass();
        $michel->name = 'Michel';
        $michel->age = 23;

        $outcast = 'JD3000';

        $picture = 'https://img.youtube.com/vi/PWgvGjAhvIw/hqdefault.jpg';

        // J'envoie tout ça à ma vue pour l'afficher
        return $this->render('home/index.html.twig', [
            'name' => 'Page d\'accueil',
           'article' => $article,
           'auteur' => $author,
           'user' => $michel,
           'jeanDaniel' => $jeanDaniel,
           'jd3000' => $outcast,
           'image' => $picture,
                  ]);
    }
}