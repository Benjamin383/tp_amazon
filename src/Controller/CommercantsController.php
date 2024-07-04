<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommercantsController extends AbstractController
{
    #[Route('/commercants', name: 'app_commercants')]
    public function index(): Response
    {
        return $this->render('commercants/index.html.twig', [
            'controller_name' => 'CommercantsController',
        ]);
    }
}
