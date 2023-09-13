<?php

namespace App\Filters;

use App\DTO\DTOInterface;

abstract class AbstractFilterHandler {
    protected ?AbstractFilterHandler $nextHandler;

    public function setNextHandler(AbstractFilterHandler $handler): void
    {
        $this->nextHandler = $handler;
    }

    abstract public function handle(DTOInterface $filterDTO);
}
