<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {        // gestion des users avec Faker :
        $faker = Factory::create('fr_FR');

        $genders = ['male', 'female'];

        for ($i = 0; $i <= 20; ++$i) {
            $user = new User();
            $gender = $faker->randomElement($genders);
            $firstname = $faker->firstname($gender);
            $lastname = $faker->lastName;
            $email = $faker->email;
            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99).'.jpg';
            $picture .= ($gender == 'male' ? 'men/' : 'women/').$pictureId;
            $presentation = $faker->sentence();

            $user->setFirstname($firstname)
                    ->setLastname($lastname)
                    ->setEmail($email)
                    ->setHash('password')
                    ->setAvatar($picture)
                    ->setPresentation($presentation)
                    ->initSlug();
            $manager->persist($user);
        }

        // code...
        $manager->flush();
    }
}