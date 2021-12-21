<?php

/**
 * App\Service\Planet | Get planet service.
 *
 * @category service
 *
 * @author cgcerro <cgcerro@gmail.com>
 */

namespace App\Service\Planet;

use App\Dto\Response\Planet\DtoResponsePlanet;
use App\Dto\Transformer\Response\Planet\SwApiProviderPlanetDtoTransformerResponse;
use App\Provider\Swapi\GetPlanetSwapiClient;

class GetPlanetService
{
    private GetPlanetSwapiClient $getPlanetSwapiClient;
    private SwApiProviderPlanetDtoTransformerResponse $planetDtoTransformerResponse;

    /**
     * __construct.
     *
     * @return void
     */
    public function __construct(
        GetPlanetSwapiClient $getPlanetSwapiClient,
        SwApiProviderPlanetDtoTransformerResponse $planetDtoTransformerResponse
    ) {
        $this->getPlanetSwapiClient = $getPlanetSwapiClient;
        $this->planetDtoTransformerResponse = $planetDtoTransformerResponse;
    }

    /**
     * __invoke.
     */
    public function __invoke(int $planetId): DtoResponsePlanet
    {
        $apiResponse = ($this->getPlanetSwapiClient)($planetId);

        return $this->planetDtoTransformerResponse->transformFromObject($apiResponse);
    }
}
