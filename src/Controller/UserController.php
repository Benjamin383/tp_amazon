<?php

namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Paniers;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'title' => "Amazonie",
        ]);
    }

    // #[Route('/inscription', name: 'inscription')]
    // public function inscription(): Response
    // {
    //     return $this->render('user/inscription.html.twig', [
    //         'title' => "Inscription à l'Amazonie",
    //     ]);
    // }

    #[Route('/inscription', name: 'inscription')]
    public function inscription(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $panier = new Paniers();
        $panier->setIdUser($user);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->persist($panier);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('user/inscription.html.twig', [
            'title' => "Inscription à l'Amazonie",
            'inscriptionForm' => $form->createView(),
        ]);
    }

}
