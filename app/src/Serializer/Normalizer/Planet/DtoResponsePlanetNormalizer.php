<?php

namespace App\Serializer\Normalizer\Planet;

use App\Dto\Response\Planet\DtoResponsePlanet;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DtoResponsePlanetNormalizer implements NormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'data' => [
                [
                    'type' => 'planets',
                    'id' => $object->id,
                    'attributes' => [
                        'name' => $object->name,
                        'rotation_period' => $object->rotation_period,
                        'orbital_period' => $object->orbital_period,
                        'diameter' => $object->diameter,
                        'films_count' => $object->films_count,
                        'created' => $object->created,
                        'edited' => $object->edited,
                    ],
                ],
            ],
            'links' => [
                'self' => $object->url,
            ],
        ];
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof DtoResponsePlanet;
    }
}
