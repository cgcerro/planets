<?php
/**
* App\Provider\Swapi\GetPlanetSwapiClient | Get planet from swapi.
* @category service
* @author cgcerro <cgcerro@gmail.com>
*/

namespace App\Provider\Swapi;

use App\Provider\Swapi\SwapiClient;
use stdClass;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetPlanetSwapiClient extends SwapiClient
{ 
    /**
     * __invoke
     *
     * @param  mixed $planetId
     * @return stdClass
     * @throws Exception
     */
    public function __invoke(int $planetId): stdClass
    {
        $response = $this->client->request(
            'GET',
            $this->apiUrl . '/api/planets/' . $planetId . '/'
        );

        $statusCode = $response->getStatusCode();

        if ($statusCode !== 200) {
            throw new HttpException(400, 'Planet not found');
        }

        return (object) array_merge(['id' => $planetId], $response->toArray());
    }
}