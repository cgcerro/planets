<?php

namespace App\Tests\Functional\Api\Planet;

use App\Tests\Functional\AbstractTestFunctionalBase;
use Symfony\Component\HttpFoundation\JsonResponse;


class GetPlanetControllerTest extends AbstractTestFunctionalBase
{
    public function testShouldReturnHttpOk(): void
    {
        $crawler = $this->request('GET', '/planets/1');
        $this->assertEquals($this->client->getResponse()->getStatusCode(), JsonResponse::HTTP_OK);
    }

    public function testShouldReturnHttpKo(): void
    {
        $crawler = $this->request('GET', '/planets/45656767676');
        $this->assertEquals($this->client->getResponse()->getStatusCode(), JsonResponse::HTTP_NOT_FOUND);
    }

    public function testShouldReturnValidJson(): void
    {
        $crawler = $this->request('GET', '/planets/1');

        $this->assertJsonValidResponse(
            $this->getJsonSchema('Planet/PlanetResponse'),
            $this->client->getResponse()->getContent()
        );
    }
}