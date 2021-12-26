<?php

namespace App\Tests\Functional\Api\Planet;

use App\Tests\Functional\AbstractTestFunctionalBase;
use Symfony\Component\HttpFoundation\JsonResponse;


class PostPlanetControllerTest extends AbstractTestFunctionalBase
{
    public function testShouldReturnHttpOk(): void
    {
        $content = [
            "id" => 21,
            "name" => "test",
            "rotation_period" => 200,
            "orbital_period" => 200,
            "diameter"=> 3600
        ];

        $crawler = $this->request('POST', '/planet', $content);

        $this->assertEquals($this->client->getResponse()->getStatusCode(), JsonResponse::HTTP_OK);
    }

    
    public function testShouldReturnHttpKo(): void
    {
        $content = [
            "id" => 1,
            "name" => "test",
            "rotation_period" => 200,
            "orbital_period" => 200,
            "diameter"=> 3600
        ];
        $crawler = $this->request('POST', '/planet', $content);
        $this->assertEquals($this->client->getResponse()->getStatusCode(), JsonResponse::HTTP_BAD_REQUEST);
    }

    
    public function testShouldReturnValidJson(): void
    {
        $content = [
            "id" => 22,
            "name" => "test",
            "rotation_period" => 200,
            "orbital_period" => 200,
            "diameter"=> 3600
        ];
        $crawler = $this->request('POST', '/planet', $content);
        $this->assertJsonValidResponse(
            $this->getJsonSchema('Planet/PlanetResponse'),
            $this->client->getResponse()->getContent()
        );
    }
}