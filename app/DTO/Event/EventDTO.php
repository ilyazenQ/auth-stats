<?php
namespace App\DTO\Event;

use App\DTO\DTOInterface;
use App\Models\User;

class EventDTO implements DTOInterface {

    public function __construct(
        public string $name,
        public bool $isAuth,
        public User $user,
        public ?string $ip
    )
    {
        
    }
}
