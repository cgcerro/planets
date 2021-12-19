<?php

namespace App\Dto\Transformer\Response;

interface DtoTransformerResponseInterface
{
    public function transformFromObject(object $object): object;
    public function transformFromObjects(iterable $objects): iterable;
}