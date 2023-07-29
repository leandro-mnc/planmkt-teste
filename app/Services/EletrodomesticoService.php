<?php

namespace App\Services;

use App\Helper\DbHelper;
use App\Http\Requests\EletrodomesticoRequest;
use App\Models\Eletrodomestico;
use App\Repositories\EletrodomesticoRepository;
use App\Repositories\MarcaRepository;
use Illuminate\Http\Request;

class EletrodomesticoService
{
    public function __construct(private readonly EletrodomesticoRepository $repository, private readonly MarcaRepository $marcaRepository)
    {
    }

    /**
     * @property Resquet $request
     * 
     * @return array
     */
    public function lista(Request $request)
    {
        $paginate = $this->repository->lista($request);

        return [
            'total' => $paginate->total(),
            'pagina_atual' => $paginate->currentPage(),
            'items' => $paginate->items(),
            'ultima_pagina' => $paginate->lastPage(),
            'pagina_anterior' => $paginate->previousPageUrl(),
            'proxima_pagina' => $paginate->nextPageUrl(),
            'items_por_pagina' => $paginate->perPage()
        ];
    }

    /**
     * @property int $id
     * 
     * @return
     */
    public function getEditar($id)
    {
        $eletrodomestico = $this->repository->get($id);

        if ($eletrodomestico === null) {
            return null;
        }

        return [
            'id' => $eletrodomestico->id,
            'nome' => $eletrodomestico->nome,
            'descricao' => $eletrodomestico->descricao,
            'tensao' => $eletrodomestico->tensao,
            'status' => $eletrodomestico->status,
            'marca' => $eletrodomestico->marca->codigo,
        ];
    }

    /**
     * @property EletrodomesticoRequest $request
     * 
     * @return Eletrodomestico | null
     */
    public function insere(EletrodomesticoRequest $request): Eletrodomestico | null
    {
        $requestData = $request->validated();

        $data = [
            'nome' => $requestData['nome'],
            'descricao' => $requestData['descricao'],
            'tensao' => $requestData['tensao'],
            'status' => DbHelper::getStatusByString($requestData['status']),
            'marca_id' => $this->marcaRepository->getByCodigo($requestData['marca'])->id,
        ];

        return $this->repository->insere($data);
    }

    /**
     * @property EletrodomesticoRequest $request
     * 
     * @return Eletrodomestico | null
     */
    public function atualiza(EletrodomesticoRequest $request): Eletrodomestico | null
    {
        $requestData = $request->validated();

        $data = [
            'nome' => $requestData['nome'],
            'descricao' => $requestData['descricao'],
            'tensao' => $requestData['tensao'],
            'status' => DbHelper::getStatusByString($requestData['status']),
            'marca_id' => $this->marcaRepository->getByCodigo($requestData['marca'])->id,
        ];

        return $this->repository->atualiza($data, $requestData['id']);
    }

    /**
     * @property int $id
     * 
     * @return bool
     */
    public function remove(int $id): bool
    {
        return $this->repository->delete($id) > 0;
    }
}
