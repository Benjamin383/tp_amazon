<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\ArticlesRepository;
use App\Entity\Articles;
use App\Controller\ArticlesController;
use Symfony\Bundle\SecurityBundle\Security;
use App\Repository\CommercantsRepository;
use App\Entity\User;

class ArticleControllerTest extends WebTestCase
{
    public function testIndex()
    {

        $articleMock1 = $this->createMock(Articles::class);
        $articleMock1->method('getId')->willReturn(1);
        $articleMock1->method('getNom')->willReturn("Shoes n°1");
        $articleMock1->method('getDescription')->willReturn("Mocked Shoes n°1 description");
        $articleMock1->method('getUrlImage')->willReturn("https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXxlbnwwfHwwfHx8MA%3D%3D");
        $articleMock2 = $this->createMock(Articles::class);
        $articleMock2->method('getId')->willReturn(2);
        $articleMock2->method('getNom')->willReturn("Shoes n°2");
        $articleMock2->method('getDescription')->willReturn("Mocked Shoes n°2 description");
        $articleMock2->method('getUrlImage')->willReturn("https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXxlbnwwfHwwfHx8MA%3D%3D");
        $articlesRepositoryMock = $this->createMock(ArticlesRepository::class);
        $articlesRepositoryMock->method('findAll')->willReturn([$articleMock1, $articleMock2]);

        $user = $this->createMock(User::class);
        $user->method('getRoles')->willReturn(["ROLE_USER"]);
        $security = $this->createMock(Security::class);
        $security->method('getUser')->willReturn($user);

        // $articlesController = new ArticlesController($security);

        $client = static::createClient();
        $client->getContainer()->set("Symfony\Bundle\SecurityBundle\Security", $security);
        $client->getContainer()->set("App\Repository\ArticlesRepository", $articlesRepositoryMock);
        $client->request("GET", "/articles/");
        $this->assertResponseIsSuccessful();
        // $html = $client->getResponse()->getContent();
        // file_put_contents('test.txt', $html); 

        // $crawler = $client->request('GET', '/articles/');
        // $this->assertCount(2, $client->filter('.card'));

        $this->assertSelectorTextContains('.card', 'Shoes n°1');

    }
}
