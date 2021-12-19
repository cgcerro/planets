<?php

namespace App\Dto\Transformer\Response;

use App\Dto\Transformer\Response\DtoTransformerResponseInterface;

abstract class AbstractDtoTransformerResponse implements DtoTransformerResponseInterface
{
    public function transformFromObjects(iterable $objects): iterable
    {
        $dto = [];

        foreach($objects as $object) {
            $ret[] = $this->transformFromObject($object);
        }

        return $dto;
    }
}