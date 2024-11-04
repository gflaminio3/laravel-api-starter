<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Http\Requests\Auth\V1\RegistrationRequest;
use App\Http\Responses\V1\TokenResponse;
use App\Services\Authentication;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

final readonly class RegisterController
{
    public function __construct(
        private Authentication $auth,
    ) {}

    public function __invoke(RegistrationRequest $request): Responsable
    {
        $request->ensureIsNotRateLimited();

        $token = $this->auth->register(
            payload: $request->payload(),
        );

        return new TokenResponse(
            token: $token,
            status: Response::HTTP_CREATED,
        );
    }
}
