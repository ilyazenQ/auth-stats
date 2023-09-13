<?php

namespace App\Filters\Event;

use App\Filters\AbstractFilterHandler;
use App\Models\Event;

class IpFilterHandler extends AbstractFilterHandler
{
    public function handle($filterDTO)
    {
        if ($filterDTO->type === 'by_ip') {
            return Event::getCountByIp($filterDTO);
        } elseif ($this->nextHandler) {
            return $this->nextHandler->handle($filterDTO);
        }

        return [];
    }
}
