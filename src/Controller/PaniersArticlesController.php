<?php

namespace App\Controller;

use App\Entity\PaniersArticles;
use App\Form\PaniersArticlesType;
use App\Repository\PaniersArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// #[Route('/paniers/articles')]
#[Route('/paniers')]
class PaniersArticlesController extends AbstractController
{
    #[Route('/', name: 'app_paniers_articles_index', methods: ['GET'])]
    public function index(PaniersArticlesRepository $paniersArticlesRepository): Response
    {
        return $this->render('paniers_articles/index.html.twig', [
            'paniers_articles' => $paniersArticlesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_paniers_articles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $paniersArticle = new PaniersArticles();
        $form = $this->createForm(PaniersArticlesType::class, $paniersArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($paniersArticle);
            $entityManager->flush();

            return $this->redirectToRoute('app_paniers_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('paniers_articles/new.html.twig', [
            'paniers_article' => $paniersArticle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paniers_articles_show', methods: ['GET'])]
    public function show(PaniersArticles $paniersArticle): Response
    {
        return $this->render('paniers_articles/show.html.twig', [
            'paniers_article' => $paniersArticle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_paniers_articles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PaniersArticles $paniersArticle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PaniersArticlesType::class, $paniersArticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_paniers_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('paniers_articles/edit.html.twig', [
            'paniers_article' => $paniersArticle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paniers_articles_delete', methods: ['POST'])]
    public function delete(Request $request, PaniersArticles $paniersArticle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paniersArticle->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($paniersArticle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_paniers_articles_index', [], Response::HTTP_SEE_OTHER);
    }
}
