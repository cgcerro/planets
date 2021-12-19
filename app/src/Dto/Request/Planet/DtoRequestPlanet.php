<?php
/**
* App\Dto\Request\Planet | Request planet dto.
* @category dto
* @author cgcerro <cgcerro@gmail.com>
*/

namespace App\Dto\Request\Planet;

use Symfony\Component\Validator\Constraints as Assert;

class DtoRequestPlanet
{
    /**
     * @Assert\NotBlank
     */
    public int $id;

    /**
     * @Assert\NotBlank
     */
    public string $name;

    public ?float $rotation_period;

    public ?float $orbital_period;

    public ?float $diameter;
}