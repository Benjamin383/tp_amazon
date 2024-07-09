<?php
 
namespace App\Controller;
 
use App\Entity\Articles;
use App\Entity\Commercants;
use App\Entity\User;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\CommercantsRepository;

#[Route('/articles')]
class ArticlesController extends AbstractController
{
    private ?Commercants $commercant = null;

    public function __construct(Security $security, CommercantsRepository $commercantsRepository)
    {
        $user = $security->getUser();
        if ($user instanceof User && in_array("ROLE_COMMERCANT", $user->getRoles())) {
            $this->commercant  = $commercantsRepository->findOneBy(['id' => $user->getCommercant()]);
        }
    }   

    #[Route('/', name: 'app_articles_index', methods: ['GET'])]
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index.html.twig', [
            'articles' => $articlesRepository->findAll(),
        ]);
    }
    #[Route('/commercant', name: 'app_articles_commercant', methods: ['GET'])]
    public function index_commercant(ArticlesRepository $articlesRepository): Response
    {
        return $this->render('articles/index_commercant.html.twig', [
            'articles' => $articlesRepository->findAll(["id_commercants" => $this->commercant->getId()]),
        ]);
    }
 
    #[Route('/new', name: 'app_articles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();
 
            return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        }
 
        return $this->render('articles/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }
 
    #[Route('/{id}', name: 'app_articles_show', methods: ['GET'])]
    public function show(Articles $article): Response
    {
        return $this->render('articles/show.html.twig', [
            'article' => $article,
            'commercant' => $this->commercant,
        ]);
    }
 
    #[Route('/{id}/edit', name: 'app_articles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Articles $article, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
 
            return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        }
 
        return $this->render('articles/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }
 
    #[Route('/{id}', name: 'app_articles_delete', methods: ['POST'])]
    public function delete(Request $request, Articles $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();
        }
 
        return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
    }
}