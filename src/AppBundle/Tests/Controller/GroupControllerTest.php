<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GroupControllerTest extends WebTestCase
{
    public function testGroup()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Group');
    }

}
