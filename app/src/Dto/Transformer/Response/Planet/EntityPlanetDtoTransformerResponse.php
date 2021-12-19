<?php

namespace App\Dto\Transformer\Response\Planet;

use App\Dto\Response\Planet\DtoResponsePlanet;
use App\Dto\Transformer\Response\AbstractDtoTransformerResponse;
use App\Entity\Planet;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EntityPlanetDtoTransformerResponse extends AbstractDtoTransformerResponse
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public function transformFromObject(Object $object): DtoResponsePlanet
    {
        $dto = new DtoResponsePlanet();

        $dto->id = $object->getId();
        $dto->name = $object->getName();
        $dto->rotation_period = $object->getRotationPeriod();
        $dto->orbital_period = $object->getOrbitalPeriod();
        $dto->diameter = $object->getDiameter();
        $dto->films_count = $object->getFilmsCount();
        $dto->created = $object->getCreated()->format("Y-m-d H:i:s e");
        $dto->edited = $object->getEdited()->format("Y-m-d H:i:s e");
        $dto->url = $this->router->generate('planet_get', [
            'planet' => $object->getId(),
            ], UrlGeneratorInterface::ABSOLUTE_URL);

        return $dto;
    }
}