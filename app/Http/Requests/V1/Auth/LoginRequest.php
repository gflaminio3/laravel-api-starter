<?php

declare(strict_types=1);

namespace App\Http\Requests\V1\Auth;

use App\Http\Payloads\V1\Auth\LoginPayload;
use App\Http\Requests\Concerns\RateLimited;
use Illuminate\Foundation\Http\FormRequest;

final class LoginRequest extends FormRequest
{
    use RateLimited;

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function payload(): LoginPayload
    {
        return LoginPayload::make(
            email: $this->string('email')->toString(),
            password: $this->string('password')->toString(),
        );
    }

    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'The email of the authenticating user.',
                'example' => 'johndoe@example.com',
            ],
            'password' => [
                'description' => 'The password of the authenticating user.',
                'example' => 'your-password',
            ],
        ];
    }
}
