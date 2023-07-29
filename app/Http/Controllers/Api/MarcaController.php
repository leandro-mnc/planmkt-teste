<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use App\Services\MarcaService;

class MarcaController extends Controller
{
    public function __construct(private readonly MarcaService $service) {}

    public function listaAtivos()
    {
        $apiResponse = new ApiResponse(
            'Lista de Marcas',
            ApiResponse::STATUS_GET,
            $this->service->getListaAtivos()
        );

        return $apiResponse->getJson();
    }
}
