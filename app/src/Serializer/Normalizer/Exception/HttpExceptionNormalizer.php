<?php

namespace App\Serializer\Normalizer\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class HttpExceptionNormalizer implements NormalizerInterface
{
    public function normalize($object, $format = null, array $context = [])
    {
        $ret = ['errors' => []];
        foreach ($object as $error) {
            $ret['errors'][] = [
                'status' => '422',
                'title' => 'Validation failed',
                'detail' => $error->getMessage(),
                'source' => ['pointer' => '/data/attributes/' . $error->getPropertyPath()],
            ];
        }

        return $ret;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof HttpException;
    }
}
