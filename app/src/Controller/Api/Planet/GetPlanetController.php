<?php

namespace App\Controller\Api\Planet;

use App\Dto\Response\Planet\DtoResponsePlanet;
use App\Service\Planet\GetPlanetService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;

class GetPlanetController extends AbstractFOSRestController
{
    /**
     * Get planet.
     *
     * @Rest\Get(path="/planets/{planet}", name="planet_get")
     * @Rest\View(serializerGroups={"DtoResponsePlanet"}, serializerEnableMaxDepthChecks=false)
     *
     * @OA\Tag(name="Planets")
     *
     * @OA\Response(
     *     response=200,
     *     description = "Get planet info",
     *     @Model(type=DtoResponsePlanet::class)
     * )
     *
     * @param int              $id               | planet id
     * @param GetPlanetService $getPlanetService | Planet Service
     */
    public function __invoke(int $planet, GetPlanetService $getPlanetService): DtoResponsePlanet
    {
        return ($getPlanetService)($planet);
    }
}
