<?php

declare(strict_types=1);

namespace App\Services;

use Throwable;

use App\Models\User;

use function array_merge;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\DatabaseManager;
use App\Http\Payloads\V1\Auth\LoginPayload;
use App\Http\Payloads\V1\Auth\RegisterPayload;
use Illuminate\Validation\ValidationException;

final readonly class Authentication
{
    public function __construct(
        private JWTAuth $guard,
        private Hasher $hasher,
        private DatabaseManager $database,
    ) {}

    public function login(LoginPayload $payload): string
    {
        return $this->guard->attempt(
            credentials: $payload->toArray(),
        );
    }

    /** @throws ValidationException|Throwable */
    public function register(RegisterPayload $payload): string
    {
        $this->database->transaction(
            callback: fn() => User::query()->create(
                attributes: array_merge(
                    $payload->toArray(),
                    ['password' => $this->hasher->make(
                        value: $payload->password,
                    )],
                ),
            ),
            attempts: 3,
        );

        return $this->guard->attempt(
            credentials: [
                'email' => $payload->email,
                'password' => $payload->password,
            ],
        );
    }
}
