<?php

declare(strict_types=1);

namespace App\Http\Payloads\V1\Auth;

final readonly class RegisterPayload
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {}

    public static function make(string $name, string $email, string $password): RegisterPayload
    {
        return new RegisterPayload(
            name: $name,
            email: $email,
            password: $password,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
