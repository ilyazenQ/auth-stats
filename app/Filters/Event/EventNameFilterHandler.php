<?php

namespace App\Filters\Event;

use App\Filters\AbstractFilterHandler;
use App\Models\Event;

class EventNameFilterHandler extends AbstractFilterHandler {
    public function handle($filterDTO) {
        if ($filterDTO->type === 'by_event_name') {
            return Event::getCountByEventName($filterDTO);
        } elseif ($this->nextHandler) {
            return $this->nextHandler->handle($filterDTO);
        }

        return [];
    }
}
