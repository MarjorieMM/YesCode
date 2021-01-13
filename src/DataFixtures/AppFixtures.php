<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // gestion des articles sans Faker :
        // for ($i = 1; $i < 4; ++$i) {
        //     // code...

        //     $article = new Article();
        //     $article->setTitle("Article n° $i");
        //     $article->setIntro('Ceci est une intro');
        //     $article->setContent('<h1>Lorem Ipsum...</h1>');
        //     $article->setImage('https://www.webnode.com/blog/wp-content/uploads/2016/10/Blog-intro.jpg');
        //     $article->setCreatedAt(new \DateTime('now'));

        //     $manager->persist($article);
        // }

        // gestion des articles avec Faker :

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i <= 20; ++$i) {
            $article = new Article();
            $title = $faker->sentence(2);
            $image = 'https://picsum.photos/400/300?random='.$i;
            $intro = $faker->paragraph(2);
            $content = '<p>'.implode('</p><p>', $faker->paragraphs(5)).'</p>';
            // $createdAt = $faker->dateTimeBetween('- 1 months');
            $article->setTitle($title)
                    ->setImage($image)
                    ->setIntro($intro)
                    ->setContent($content);
            // ->setCreatedAt($createdAt);
            $manager->persist($article);
        }

        // code...
        $manager->flush();
    }
}