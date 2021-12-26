<?php

namespace App\Serializer\Normalizer\Validator;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\ConstraintViolationList;

class ConstraintViolationListNormalizer implements NormalizerInterface
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

    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof ConstraintViolationList;
    }
}
