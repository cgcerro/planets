<?php

namespace App\Dto\Response\Planet;

use OpenApi\Annotations as OA;

class DtoResponsePlanet
{
    /**
     * @OA\Property(description="The unique identifier of the planet.")
     */
    public int $id;

    /**
     * @OA\Property(description="Planet name.")
     */
    public string $name;

    /**
     * @OA\Property(description="Rotation period.")
     */
    public ?float $rotation_period;

    /**
     * @OA\Property(description="Orbital Period")
     */
    public ?float $orbital_period;

    /**
     * @OA\Property(description="Diameter")
     */
    public ?float $diameter;

    /**
     * @OA\Property(description="Films count")
     */
    public ?float $films_count;

    /**
     * @OA\Property(description="Created")
     */
    public string $created;

    /**
     * @OA\Property(description="Edited at")
     */
    public string $edited;

    /**
     * @OA\Property(description="Api endpint url")
     */
    public ?string $url;
}
