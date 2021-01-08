<?php

namespace App\DataFixtures;

use App\Entity\Fruit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; ++$i) {
            // code...
            $fruit = new Fruit();
            $fruit->setNom('Fruit n°'.$i);
            $fruit->setForme('Forme n°'.$i);
            $fruit->setPoids($i + 1);
            $fruit->setPrix($i + 2);
            $manager->persist($fruit);
        }
        // $product = new Product();

        $manager->flush();
    }
}