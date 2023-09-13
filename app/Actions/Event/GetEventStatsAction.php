<?php

namespace App\Actions\Event;

use App\Actions\ActionInterface;
use App\DTO\Event\FilterDTO;
use App\Filters\AbstractFilterHandler;
use App\Filters\Event\AuthStatusFilterHandler;
use App\Filters\Event\EventNameFilterHandler;
use App\Filters\Event\IpFilterHandler;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

class GetEventStatsAction implements ActionInterface
{
    public function execute(array $request): Collection
    {
        $filterDTO = new FilterDTO(
            $request['name'],
            $request['date_from'],
            $request['date_to'],
            $request['type']
        );

        return $this->getFilterHandler()->handle($filterDTO);
    }

    private function getFilterHandler(): AbstractFilterHandler
    {
        $eventNameHandler = new EventNameFilterHandler();
        $ipHandler = new IpFilterHandler();
        $authStatusHandler = new AuthStatusFilterHandler();

        $eventNameHandler->setNextHandler($ipHandler);
        $ipHandler->setNextHandler($authStatusHandler);

        return $eventNameHandler;
    }

}
