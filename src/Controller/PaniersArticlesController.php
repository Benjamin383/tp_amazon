<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PaniersArticlesController extends AbstractController
{
    #[Route('/paniers/articles', name: 'app_paniers_articles')]
    public function index(): Response
    {
        return $this->render('paniers_articles/index.html.twig', [
            'controller_name' => 'PaniersArticlesController',
        ]);
    }
}
