<?php

namespace App\Controller;

use App\Entity\Commercants;
use App\Entity\User;
use App\Form\CommercantsType;
use App\Repository\CommercantsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/commercants')]
class CommercantsController extends AbstractController
{
    #[Route('/dashboard', name: 'app_commercants_dashboard', methods: ['GET'])]
    public function dashboard(CommercantsRepository $commercantsRepository, Security $security): Response
    {
        $user = $security->getUser();
        if($user instanceof User && in_array("ROLE_COMMERCANT", $user->getRoles())){
            return $this->render('commercants/dashboard.html.twig', [
                'commercant' => $commercantsRepository->findOneBy(['id' => $user->getCommercant()]),
            ]);
        }else{
            return $this->redirectToRoute('app_commercants_new');
        }
    }

    #[Route('/', name: 'app_commercants_index', methods: ['GET'])]
    public function index(CommercantsRepository $commercantsRepository, Security $security): Response
    {
        $user = $security->getUser();
        if(in_array("ROLE_COMMERCANT", $user->getRoles())){
            return $this->redirectToRoute('app_commercants_dashboard');

        }else{
            return $this->redirectToRoute('app_commercants_new');
        }
    }

    #[Route('/new', name: 'app_commercants_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        
        $commercant = new Commercants();
        $user = $security->getUser();
        $commercant->setIdUser($user);
        $form = $this->createForm(CommercantsType::class, $commercant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($commercant);
            $entityManager->flush();

            return $this->redirectToRoute('app_commercants_index', ["id_user" => $commercant->getIdUser()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commercants/new.html.twig', [
            'commercant' => $commercant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commercants_show', methods: ['GET'])]
    public function show(Commercants $commercant): Response
    {
        return $this->render('commercants/show.html.twig', [
            'commercant' => $commercant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commercants_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commercants $commercant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommercantsType::class, $commercant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_commercants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commercants/edit.html.twig', [
            'commercant' => $commercant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commercants_delete', methods: ['POST'])]
    public function delete(Request $request, Commercants $commercant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commercant->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($commercant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_commercants_index', [], Response::HTTP_SEE_OTHER);
    }
}
