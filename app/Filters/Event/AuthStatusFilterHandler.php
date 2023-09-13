<?php

namespace App\Filters\Event;

use App\Filters\AbstractFilterHandler;
use App\Models\Event;

class AuthStatusFilterHandler extends AbstractFilterHandler
{
    public function handle($filterDTO)
    {
        if ($filterDTO->type === 'by_auth_status') {
            return Event::getCountByAuthStatus($filterDTO);
        } elseif ($this->nextHandler) {
            return $this->nextHandler->handle($filterDTO);
        }

        return [];
    }
}
