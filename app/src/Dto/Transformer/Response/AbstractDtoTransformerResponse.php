<?php

namespace App\Dto\Transformer\Response;

abstract class AbstractDtoTransformerResponse implements DtoTransformerResponseInterface
{
    public function transformFromObjects(iterable $objects): iterable
    {
        $dto = [];

        foreach ($objects as $object) {
            $ret[] = $this->transformFromObject($object);
        }

        return $dto;
    }
}
