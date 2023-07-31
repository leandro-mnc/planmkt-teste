<?php

namespace App\Http\Response;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public const STATUS_GET = 'get';

    public const STATUS_CREATED = 'created';
    
    public const STATUS_UPDATED = 'updated';

    public const STATUS_DELETED = 'deleted';

    public const STATUS_ERROR = 'error';

    private const STATUS_OK = 'success';

    private const STATUS_NOT_OK = 'error';

    private const STATUS_CODE = [
        self::STATUS_GET => 200,
        self::STATUS_CREATED => 201,
        self::STATUS_UPDATED => 200,
        self::STATUS_DELETED => 200,
        self::STATUS_ERROR => 402,
    ];

    public function __construct(private readonly string $message, private readonly string $status, private readonly array $data = []) {}

    public function getJson()
    {
        $response = [
            'status' => $this->getStatus(),
            'message' => $this->message
        ];

        if (count($this->data) > 0) {
            $response['data'] = $this->data;
        }

        return new JsonResponse($response, $this->getCode());
    }

    private function getStatus()
    {
        return match ($this->status) {
            self::STATUS_ERROR => self::STATUS_NOT_OK,
            default => self::STATUS_OK,
        };
    }

    private function getCode()
    {
        if (array_key_exists($this->status, self::STATUS_CODE) === true) {
            return self::STATUS_CODE[$this->status];            
        }
        return 200;
    }
}