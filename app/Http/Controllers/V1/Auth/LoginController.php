<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Services\Authentication;
use App\Http\Responses\V1\TokenResponse;
use App\Http\Requests\V1\Auth\LoginRequest;
use Illuminate\Contracts\Support\Responsable;

final readonly class LoginController
{
    public function __construct(
        private Authentication $auth,
    ) {}

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
