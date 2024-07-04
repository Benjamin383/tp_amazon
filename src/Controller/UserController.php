<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'title' => "Amazonie",
        ]);
    }

    #[Route('/inscription', name: 'inscription')]
    public function inscription(): Response
    {
        return $this->render('user/inscription.html.twig', [
            'title' => "Inscription à l'Amazonie",
        ]);
    }
}
