<?php

namespace App\Provider\Swapi;

use stdClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetPlanetSwapiClient extends SwapiClient
{
    /**
     * __invoke.
     *
     * @param mixed $planetId
     *
     * @throws Exception
     */
    public function __invoke(int $planetId): stdClass
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . '/api/planets/' . $planetId . '/'
        );

        $statusCode = $response->getStatusCode();

        if (200 !== $statusCode) {
            throw new HttpException(JsonResponse::HTTP_NOT_FOUND, 'Planet not found');
        }

        return (object) array_merge(['id' => $planetId], $response->toArray());
    }
}
