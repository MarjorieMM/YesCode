<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(UserRepository $repo): Response
    {
        $users = $repo->selectUserWithFullname();
        dump($users);

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/user/new", name="user_register")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', "L'utilisateur <strong>{$user->getLastname()}</strong> a bien été créé");

            return $this->redirectToRoute('user_show', [
            'slug' => $user->getSlug(),
        ]);
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/{slug}/edit", name="user_update")
     */
    public function update(EntityManagerInterface $manager, Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Vos informations ont bien été mises à jour');

            return $this->redirectToRoute('user_show', [
                'slug' => $user->getSlug(),
            ]);
        }

        return $this->render('user/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/users/{slug}/delete", name="user_delete")
     */
    public function delete($slug, EntityManagerInterface $manager, UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBySlug($slug);
        $manager->remove($user);
        $manager->flush();

        $this->addFlash('success', 'Votre compte a bien été supprimé');

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/user/show/{slug}", name="user_show")
     */
    public function show($slug, UserRepository $userRepository)
    {
        $user = $userRepository->findOneBySlug($slug);
        dump($user);

        return $this->render('user/show.html.twig', [
                'user' => $user,
            ]);
    }

//     /**
//      * @Route("/user/connect", name="user_connection")
//      */

//      public function connect(Request $request)
//
}