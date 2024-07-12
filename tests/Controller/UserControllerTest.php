<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testInscription()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/inscription');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Inscription');

        $new_user = "Test_user".strval(rand(1000000,9999999))."@gmail.com";

        $form = $crawler->selectButton("S'inscrire")->form([
            'user[email]' => $new_user,
            'user[plainPassword][first]' => "azerty",
            'user[plainPassword][second]' => "azerty",
        ]);

        $client->submit($form);

        $this->assertResponseRedirects('/');
        $client->followRedirect();
        $this->assertSelectorTextContains('h1', "Homepage");

        $crawler = $client->request('GET', '/connexion');

        $form = $crawler->selectButton("Connexion")->form([
            '_username' => $new_user,
            '_password' => "azerty",
        ]);
        $client->submit($form);

        $this->assertResponseRedirects('/');
        $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('#user_email', $new_user);
    }
}