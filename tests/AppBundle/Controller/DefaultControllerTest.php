<?php

namespace tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin@example.com',
            'PHP_AUTH_PW' => 'admin',
        ]);
    }

    public function testIndex()
    {
        $this->logIn();
        $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function testLoginPage()
    {
        $this->client->request('GET', '/login');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewall = 'secured_area';
        $token = new UsernamePasswordToken('admin@example.com', null, $firewall, ['ROLE_SUPER_ADMIN']);
        $session->set('_security_' . $firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}
