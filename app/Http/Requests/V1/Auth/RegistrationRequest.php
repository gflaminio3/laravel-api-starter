<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth\V1;

use App\Http\Requests\Concerns\RateLimited;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Payloads\V1\Auth\RegisterPayload;

final class RegistrationRequest extends FormRequest
{
    use RateLimited;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function payload(): RegisterPayload
    {
        return RegisterPayload::make(
            name: $this->string('name')->toString(),
            email: $this->string('email')->toString(),
            password: $this->string('password')->toString(),
        );
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'The name of the registering user.',
                'example' => 'John Doe',
            ],
            'email' => [
                'description' => 'The email of the registering user.',
                'example' => 'johndoe@example.com',
            ],
            'password' => [
                'description' => 'The password of the registering user.',
                'example' => 'your-password',
            ],
        ];
    }
}
