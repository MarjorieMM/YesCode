<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 4; $i++) { 
            # code...

            $article = new 
        }
        // code...
    }

    // $product = new Product();
        // $manager->persist($product);
        // $manager->flush();
}