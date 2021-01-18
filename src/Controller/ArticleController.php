<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    // public function index(ArticleRepository $repo): Response
    // {
    public function index(): Response
    {
        $articleRepository = $this->getDoctrine()
        ->getManager()
        ->getRepository('App\Entity\Article');
        $articles = $articleRepository->findAll();

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/articles/new", name="article_create")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setAuthor($this->getUser());
            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', "L'article <strong>{$article->getTitle()}</strong> a bien été créé");

            return $this->redirectToRoute('article_show', [
            'slug' => $article->getSlug(),
        ]);
        }

        return $this->render('article/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/articles/{slug}", name="article_show")
     */
    // public function index(ArticleRepository $repo): Response
    // {
    public function show($slug, ArticleRepository $articleRepository)
    {
        $article = $articleRepository->findOneBySlug($slug);
        dump($article);

        return $this->render('article/show.html.twig', [
                'article' => $article,
            ]);
    }

    /**
     * @Route("/articles/{slug}/edit", name="article_update")
     */
    public function update(EntityManagerInterface $manager, Request $request, Article $article, $slug, ArticleRepository $articleRepository): Response
    {
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $article->setAuthor($this->getUser());
            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', "L'article <strong>{$article->getTitle()}</strong> a bien été mis à jour");

            return $this->redirectToRoute('article_show', [
                'slug' => $article->getSlug(),
            ]);
        }

        return $this->render('article/update.html.twig', [
            'form' => $form->createView(),
            'article' => $article,
        ]);
    }

    /**
     * @Route("/articles/{slug}/delete", name="article_delete")
     */
    public function delete($slug, EntityManagerInterface $manager, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->findOneBySlug($slug);
        $manager->remove($article);
        $manager->flush();

        $this->addFlash('success', "L'article a bien été supprimé");

        return $this->redirectToRoute('articles');
    }
}