<?php

namespace App\Controller\Api\Planet;

use App\Dto\Response\Planet\DtoResponsePlanet;
use App\Service\Planet\GetPlanetService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class GetPlanetController extends AbstractFOSRestController
{
    /**
     * @Rest\Get(path="/planets/{planet}", name="planet_get")
     * @QueryParam(name="planet", requirements="\d+", default="1", description="Planet Id.")
     * @Rest\View(serializerGroups={"DtoResponsePlanet"}, serializerEnableMaxDepthChecks=false)
     * 
     * @param int $id | planet id
     * @param GetPlanetService $getPlanetService | Planet Service
     */
    public function __invoke(int $planet, GetPlanetService $getPlanetService): DtoResponsePlanet
    {
        return ($getPlanetService)($planet);
    }
}
