<?php

namespace App\Controller\Api\Planet;

use App\Dto\Request\Planet\DtoRequestPlanet;
use App\Dto\Response\Planet\DtoResponsePlanet;
use App\Service\Planet\PostPlanetService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Annotations as OA;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class PostPlanetController extends AbstractFOSRestController
{
    /**
     * Create planet.
     *
     * @Rest\Post(path="/planet", name="planet_post")
     * @Rest\View(serializerGroups={"DtoResponsePlanet"}, serializerEnableMaxDepthChecks=false)
     * @ParamConverter("planetRequest", converter="fos_rest.request_body")
     *
     * @OA\Tag(name="Planets")
     *
     * @OA\Response(
     *     response=200,
     *     description = "Planet info",
     *     @Model(type=DtoResponsePlanet::class)
     * )
     * @OA\RequestBody(
     *     description = "Planet info request",
     *     @Model(type=DtoRequestPlanet::class)
     * )
     */
    public function __invoke(
        DtoRequestPlanet $planetRequest,
        ConstraintViolationListInterface $validationErrors,
        PostPlanetService $postPlanetService
    ) {
        if (\count($validationErrors) > 0) {
            return $validationErrors;
        }

        return ($postPlanetService)($planetRequest);
    }
}
