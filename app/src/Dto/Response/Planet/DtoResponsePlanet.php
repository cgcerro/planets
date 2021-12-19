<?php
/**
* App\Dto\Response\Planet | Response planet dto.
* @category dto
* @author cgcerro <cgcerro@gmail.com>
*/

namespace App\Dto\Response\Planet;

class DtoResponsePlanet
{
    public int $id;
    public string $name;
    public ?float $rotation_period;
    public ?float $orbital_period;
    public ?float $diameter;
    public ?float $films_count;
    public string $created;
    public string $edited;
    public ?string $url; 
}