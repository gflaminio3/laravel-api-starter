<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth\V1;

use App\Http\Requests\Auth\V1\LoginRequest;
use App\Http\Responses\V1\TokenResponse;
use App\Services\Authentication;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Validation\ValidationException;

final readonly class LoginController
{
    public function __construct(
        private Authentication $auth,
    ) {}

    /** @throws ValidationException */
    public function __invoke(LoginRequest $request): Responsable
    {
        $request->ensureIsNotRateLimited();

        $token = $this->auth->login(
            payload: $request->payload(),
        );

        return new TokenResponse(
            token: $token,
        );
    }
}
