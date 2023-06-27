<?php

namespace App\Actions\Event;

use App\Actions\ActionInterface;
use App\DTO\Event\EventDTO;
use App\Models\Event;

class CreateEventAction implements ActionInterface
{
    public function execute(array $request): Event
    {
        $DTO = new EventDTO(
            $request['name'],
            $request['is_auth'],
            auth()->user(),
            $request['ip']
        );
        
        return Event::createFromDTO($DTO);
    }

}