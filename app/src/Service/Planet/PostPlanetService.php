<?php

/**
 * App\Service\Planet | Get planet service.
 * @category service
 * @author cgcerro <cgcerro@gmail.com>
 */

namespace App\Service\Planet;

use App\Dto\Request\Planet\DtoRequestPlanet;
use App\Dto\Response\Planet\DtoResponsePlanet;
use App\Dto\Transformer\Response\Planet\EntityPlanetDtoTransformerResponse;
use App\Entity\Planet;
use App\Repository\PlanetRepository;
use DateTime;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PostPlanetService
{    
    private PlanetRepository $planetRepository;
    private EntityPlanetDtoTransformerResponse $planetDtoTransformerResponse;
        
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        PlanetRepository $planetRepository,
        EntityPlanetDtoTransformerResponse $planetDtoTransformerResponse)
    {
        $this->planetRepository = $planetRepository;
        $this->planetDtoTransformerResponse = $planetDtoTransformerResponse;
    }

    /**
     * __invoke
     *
     * @return DtoResponsePlanet
     */
    public function __invoke(DtoRequestPlanet $planetRequest) : DtoResponsePlanet
    {
        $planet = $this->planetRepository->findOneBy(['id' => $planetRequest->id]);
        if ($planet) {
            throw new HttpException(400, 'Planet already exists');
        }
        
        $planet = new Planet();
        $planet->setId($planetRequest->id);
        $planet->setName($planetRequest->name);
        $planet->setRotationPeriod($planetRequest->rotation_period ?? null);
        $planet->setOrbitalPeriod($planetRequest->orbital_period ?? null);
        $planet->setDiameter($planetRequest->diameter ?? null);
        $planet->setCreated(new DateTime());
        $planet->setEdited(new DateTime());

        $this->planetRepository->save($planet);

        $planet = $this->planetRepository->findOneBy(['id' => $planetRequest->id]);

        return $this->planetDtoTransformerResponse->transformFromObject($planet);
    }
}