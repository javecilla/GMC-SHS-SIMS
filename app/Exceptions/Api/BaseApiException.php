<?php

namespace App\Exceptions\Api;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

abstract class BaseApiException extends Exception
{
    /**
     * The HTTP status code to be returned.
     */
    protected int $status = Response::HTTP_BAD_REQUEST;

    /**
     * Any additional data (optional).
     */
    protected array $data = [];

    /**
     * Override to customize default message.
     */
    public function __construct(string $message = null, array $data = [], ?int $status = null)
    {
        parent::__construct($message ?? $this->defaultMessage());
        $this->data = $data;

        if ($status !== null) {
            $this->status = $status;
        }
    }


    /**
     * Get the default error message.
     */
    abstract protected function defaultMessage(): string;

    /**
     * Render as a JSON response.
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'error' => class_basename($this),
            'data' => $this->data,
        ], $this->status);
    }
}
