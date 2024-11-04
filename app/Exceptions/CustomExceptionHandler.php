<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class CustomExceptionHandler
{
    /**
     * Helper function to format the JSON response.
     *
     * @param bool $success
     * @param string $message
     * @param mixed|null $data
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    private function formatResponse(bool $success, string $message, $data = null, int $statusCode = 200)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Handle NotFoundHttpException.
     *
     * @param NotFoundHttpException $e
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleNotFoundHttpException(NotFoundHttpException $e, Request $request)
    {
        if ($request->is('api/*')) {
            return $this->formatResponse(false, 'Record not found.', null, 404);
        }
    }

    /**
     * Handle ValidationException.
     *
     * @param ValidationException $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleValidationException(ValidationException $e)
    {
        return $this->formatResponse(false, $e->getMessage(), null, $e->status);
    }

    /**
     * Handle HttpException.
     *
     * @param HttpException $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleHttpException(HttpException $e)
    {
        return $this->formatResponse(false, $e->getMessage(), null, $e->getStatusCode());
    }

    /**
     * Handle any generic Throwable exceptions.
     *
     * @param Throwable $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleGenericException(Throwable $e)
    {
        return $this->formatResponse(false, 'An error occurred.', null, 500);
    }
}
