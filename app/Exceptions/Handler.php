<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Exceptions\ApiException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, Request $request) {
            if ($e instanceof ApiException) {
                return $this->renderApiException($e);
            } elseif ($e instanceof ValidationException) {
                return report($e);
            }

            return $this->renderThrowable($e, $request);
        });
    }

    public function renderThrowable(Throwable $e, Request $request)
    {
        if ($request->acceptsJson()) {
            $response = [
                'status' => 'error',
                'message' => 'Não foi possível processar a requisição'
            ];

            if (App::environment() === 'local') {
                $response['exception'] = [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                ];
            }

            return response()->json($response, 402);
        }
    }

    public function renderApiException(ApiException $e): JsonResponse
    {
        return new JsonResponse([
            'status' => 'error',
            'message' => $e->getMessage()
        ], $e->getCode() < 1 ? 402 : $e->getCode());
    }
}
