<?php

namespace App\Tests\Functional;

use JsonSchema\Validator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\HttpClientKernel;

abstract class AbstractTestFunctionalBase extends WebTestCase
{
    protected const BASE_URL = '/api'; // Todo: set as parameter
    protected $client;
    protected static string $schemaPath;
    
    /**
     * setUp
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->client = static::createClient();

        if (empty(self::$schemaPath)) {
            self::$schemaPath = sprintf(
                '%s/tests/Schemas',
                $this->client->getContainer()->getParameter('kernel.project_dir')
            );
        }
    }
    
    /**
     * request
     *
     * @param  string $method
     * @param  string $url
     * @return void
     */
    protected function request(string $method, string $url, $content = null) {
        return $this->client->request(
            $method,
            self::BASE_URL . $url,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $content ? json_encode($content) : null);
    }

        
    /**
     * assertJsonValidResponse
     *
     * @param  array $jsonSchema
     * @param  string $jsonToValidate
     * @return void
     */
    protected function assertJsonValidResponse(array $jsonSchema, string $jsonToValidate): void
    {
        $jsonToValidateObject = json_decode($jsonToValidate);
        $schemaObj = json_decode(json_encode($jsonSchema));

        $validator = new Validator();
        $validator->validate($jsonToValidateObject, $schemaObj);
        $validationError = '';

        if (!$validator->isValid()) {
            foreach ($validator->getErrors() as $error) {
                $validationError .= sprintf("[%s] %s\n", $error['property'], $error['message']);
            }
        }
        self::assertTrue($validator->isValid(), $validationError);
    }

    /**
     * Get Object Schema from Json File Inside Of Schemas Folder.
     *
     * @return object
     */
    protected function getJsonSchema(string $schema): array
    {
        $pathToSchema = realpath(self::$schemaPath."/{$schema}.json");
        if (!file_exists($pathToSchema)) {
            throw new FileNotFoundException();
        }
        $schema = json_decode(file_get_contents($pathToSchema), true);

        return $this->getRelatedJsonSchema($schema);
    }



    /**
     * Get related Json schema recursively.
     */
    private function getRelatedJsonSchema(array $jsonArr): array
    {
        $tempArray = [];
        $relatedAttr = '$ref';
        foreach ($jsonArr as $key => $value) {
            if ($key === $relatedAttr) {
                $pathToRelatedSchema = self::$schemaPath.'/'.$jsonArr[$key];
                if (!file_exists($pathToRelatedSchema)) {
                    throw new FileNotFoundException($pathToRelatedSchema);
                }
                // Get related json from FileSystem
                $value = json_decode(file_get_contents($pathToRelatedSchema), true);
                // Unset ref in original array
                unset($jsonArr[$key]);
            }
            if (is_array($value)) {
                $value = $this->getRelatedJsonSchema($value);
            }
            if ($key === $relatedAttr) {
                // If is a related json overwrite all the content
                $tempArray = $value;
            } else {
                $tempArray[$key] = $value;
            }
        }

        return $tempArray;
    }
} 