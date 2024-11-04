<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Services\Authentication;
use App\Http\Responses\V1\TokenResponse;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\V1\Auth\RegistrationRequest;

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
            $token,
            Response::HTTP_CREATED,
        );
    }
}
