<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class SimpleTest extends ApiTestCase
{

    public function testGet()
    {
        $client = self::createClient();
        $client->request(
            method: 'GET',
            url   : '/detached/1'
        );

        $this->assertResponseStatusCodeSame(200);
    }

    public function testGetCollection()
    {
        $client = self::createClient();
        $client->request(
            method: 'GET',
            url   : '/detached'
        );

        $this->assertResponseStatusCodeSame(200);
    }
}