<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 4; ++$i) {
            // code...

            $article = new Article();
            $article->setTitle("Article n° $i");
            $article->setIntro('Ceci est une intro');
            $article->setContent('<h1>Lorem Ipsum...</h1>');
            $article->setImage('https://www.webnode.com/blog/wp-content/uploads/2016/10/Blog-intro.jpg');
            $article->setCreatedAt(new \DateTime('now'));
            $manager->persist($article);
        }
        // code...
        $manager->flush();
    }

    // $product = new Product();
        // $manager->persist($product);
        // $manager->flush();
}