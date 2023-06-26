<?php

namespace App\DTO\User;

use App\DTO\DTOInterface;

class UserRegisterDTO implements DTOInterface 
{
    public ?string $name;
    public ?string $email;
    public ?string $password;

    public function fillFromFields(array $fields): UserRegisterDTO
    {
        $this->name = $fields['name'];
        $this->email = $fields['email'];
        $this->password = $fields['password'];

        return $this;
    }
}