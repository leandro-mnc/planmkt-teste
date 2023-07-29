<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Requests\EletrodomesticoRequest;
use App\Http\Response\ApiResponse;
use App\Services\EletrodomesticoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class EletrodomesticoController extends Controller
{
    public function __construct(private readonly EletrodomesticoService $service) {}

    /**
     * @property Request $request
     * 
     * @return array
     */
    public function index(Request $request) 
    {
        $apiResponse = new ApiResponse(
            'Lista de Eletrodomésticos',
            ApiResponse::STATUS_GET,
            $this->service->lista($request)
        );

        return $apiResponse->getJson();
    }

    /**
     * @throws RouteNotFoundException
     */
    public function create(): void
    {
        throw new RouteNotFoundException('Página não encontrada');
    }

    /**
     * Insere
     * 
     * @property EletrodomesticoRequest $request
     * 
     * @return JsonResponse
     */
    public function store(EletrodomesticoRequest $request): JsonResponse
    {
        $eletrodomestico = $this->service->insere($request);

        if ($eletrodomestico === null) {
            throw new ApiException('Não foi possível inserir o eletrodoméstico', 402);
        }

        $apiResponse = new ApiResponse(
            'Eletrodoméstico criado com sucesso',
            ApiResponse::STATUS_CREATED,
            [
                'id' => $eletrodomestico->id,
                'nome' => $eletrodomestico->nome,
                'descricao' => $eletrodomestico->descricao,
                'tensao' => $eletrodomestico->tensao,
                'status' => $eletrodomestico->status,
                'marca' => $eletrodomestico->marca->nome,
            ]
        );

        return $apiResponse->getJson();
    }

    public function show(string $id)
    {
        throw new RouteNotFoundException('Página não encontrada');
    }

    public function edit(string $id)
    {
        $eletrodomestico = $this->service->getEditar($id);

        if ($eletrodomestico === null) {
            throw new ApiException('Não foi possível buscar o eletrodoméstico', 402);
        }

        $apiResponse = new ApiResponse(
            'Eletrodoméstico editar',
            ApiResponse::STATUS_GET,
            $eletrodomestico
        );

        return $apiResponse->getJson();
    }

    /**
     * Atualiza
     * 
     * @property EletrodomesticoRequest $request
     * 
     * @return JsonResponse
     */
    public function update(EletrodomesticoRequest $request, string $id): JsonResponse
    {
        $eletrodomestico = $this->service->atualiza($request);

        if ($eletrodomestico === null) {
            throw new ApiException('Não foi possível atualizar o eletrodoméstico', 402);
        }

        $apiResponse = new ApiResponse(
            'Eletrodoméstico atualizado com sucesso',
            ApiResponse::STATUS_UPDATED,
            [
                'id' => $eletrodomestico->id,
                'nome' => $eletrodomestico->nome,
                'descricao' => $eletrodomestico->descricao,
                'tensao' => $eletrodomestico->tensao,
                'status' => $eletrodomestico->status,
                'marca' => $eletrodomestico->marca->nome,
            ]
        );

        return $apiResponse->getJson();
    }

    /**
     * Delete
     * 
     * @property string $id
     * 
     * @return JsonResponse
     * 
     * @throws ApiException
     */
    public function destroy(string $id): JsonResponse
    {
        $status = $this->service->remove($id);

        if ($status === true) {
            return (new ApiResponse(
                'Eletrodoméstico deletado com sucesso',
                ApiResponse::STATUS_DELETED,
            ))->getJson();
        }

        throw new ApiException('Não foi possível remover o Eletrodoméstico', 402);
    }
}
