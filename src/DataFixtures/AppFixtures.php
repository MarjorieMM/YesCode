<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // création des utilisateurs avec Faker
        $faker = Factory::create('fr_FR');
        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser->setFirstName('Jean')
                     ->setLastname('Bon')
                     ->setEmail('JB_800@gmail.com')
                     ->setHash($this->encoder->encodePassword($adminUser, 'password'))
                     ->setAvatar('https://randomuser.me/api/portraits/men/56')
                     ->setPresentation('Compte du super utilisateur')
                     ->addUserRole($adminRole);
        $manager->persist($adminUser);
        $users = [];
        // Tableau users pour faire des auteurs aléatoires
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
            $hash = $this->encoder->encodePassword($user, 'password');
            $presentation = $faker->sentence();

            $user->setFirstname($firstname)
                     ->setLastname($lastname)
                     ->setEmail($email)
                     ->setHash($hash)
                     ->setAvatar($picture)
                     ->setPresentation($presentation)
                     ->initSlug();
            $manager->persist($user);
            $users[] = $user;
        }
        // création des articles avec Faker

        for ($i = 0; $i <= 20; ++$i) {
            $article = new Article();
            $title = $faker->sentence(2);
            $image = 'https://picsum.photos/400/300?random='.$i;
            $intro = $faker->paragraph(2);
            $content = '<p>'.implode('</p><p>', $faker->paragraphs(5)).'</p>';
            $author = $users[mt_rand(0, count($users) - 1)];
            $article->setTitle($title)
                    ->setImage($image)
                    ->setIntro($intro)
                    ->setContent($content)
                    ->setAuthor($author);

            $manager->persist($article);
        }

        // code...
        $manager->flush();
    }
}