<?php
namespace App\DTO\Event;

use App\DTO\DTOInterface;

class FilterDTO implements DTOInterface {

    public function __construct(
        public string $name,
        public string $dateFrom,
        public string $dateTo,
        public string $type
    )
    {
        
    }
}
