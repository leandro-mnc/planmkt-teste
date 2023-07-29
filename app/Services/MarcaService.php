<?php

namespace App\Services;

use App\Repositories\MarcaRepository;

class MarcaService
{
    public function __construct(private readonly MarcaRepository $repository) {}

    public function getListaAtivos(): array {
        return $this->repository->getListaAtivos()->map(function($item) {
            return [
                'codigo' => $item->codigo,
                'nome' => $item->nome,
            ];
        })->all();
    }
}