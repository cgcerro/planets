<?php

namespace App\Dto\Transformer\Response\Planet;

use App\Dto\Response\Planet\DtoResponsePlanet;
use App\Dto\Transformer\Response\AbstractDtoTransformerResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SwApiProviderPlanetDtoTransformerResponse extends AbstractDtoTransformerResponse
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public function transformFromObject(object $object): DtoResponsePlanet
    {
        $dto = new DtoResponsePlanet();

        $dto->id = $object->id;
        $dto->name = $object->name;
        $dto->rotation_period = $object->rotation_period;
        $dto->orbital_period = $object->orbital_period;
        $dto->diameter = $object->diameter;
        $dto->films_count = count($object->films);
        $dto->created = $object->created;
        $dto->edited = $object->edited;
        $dto->url = $this->router->generate('planet_get', [
            'planet' => $object->id,
            ], UrlGeneratorInterface::ABSOLUTE_URL);
        $object->rotation_period;

        return $dto;
    }
}
